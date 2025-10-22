<?php
// app/Http/Controllers/customer/ProductController.php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Product;
use App\Models\admin\Category;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        // === Lọc theo danh mục ===
        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category_id', $request->category);
        }

        // === Lọc theo giá ===
        if ($request->filled('price_range')) {
            switch ($request->price_range) {
                case '0-20':
                    $query->whereBetween('price', [0, 20000000]);
                    break;
                case '20-40':
                    $query->whereBetween('price', [20000000, 40000000]);
                    break;
                case '40+':
                    $query->where('price', '>', 40000000);
                    break;
            }
        }

        // === Lọc theo thương hiệu ===
        if ($request->filled('brand')) {
            $query->where('brand', $request->brand);
        }

        // === Sắp xếp ===
        $allowedSorts = ['name', 'price', 'brand', 'created_at'];
        $sortBy = in_array($request->get('sort_by'), $allowedSorts)
            ? $request->get('sort_by')
            : 'name';
        $sortDirection = $request->get('sort_direction') === 'desc' ? 'desc' : 'asc';

        $products = $query->orderBy($sortBy, $sortDirection)
            ->paginate(12)
            ->withQueryString();

        // === Gắn trạng thái tồn kho ===
        $products->getCollection()->transform(function ($p) {
            $p->status = $p->quantity == 0
                ? 'Hết hàng'
                : ($p->quantity < 10 ? 'Sắp hết hàng' : 'Còn hàng');
            return $p;
        });

        // === Lấy danh sách danh mục và thương hiệu ===
        $categories = Category::select('category_id', 'name')->get();
        $brands = Product::select('brand')->distinct()->pluck('brand');

        // === Trả về view ===
        return view('customer.product', compact('products', 'categories', 'brands', 'sortBy', 'sortDirection'));
    }


    // JSON list cho AJAX (giữ nguyên nếu bạn đang dùng)
    public function listJson(Request $request)
    {
        $query = Product::query();

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category_id', $request->category);
        }
        if ($request->filled('search')) {
            $search = mb_strtolower(trim($request->search));
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"])
                  ->orWhereRaw('LOWER(brand) LIKE ?', ["%{$search}%"])
                  ->orWhereRaw('LOWER(product_id) LIKE ?', ["%{$search}%"]);
            });
        }

        $allowedSorts = ['name', 'price', 'brand', 'created_at'];
        $sortBy = in_array($request->get('sort_by'), $allowedSorts) ? $request->get('sort_by') : 'name';
        $sortDirection = $request->get('sort_direction') === 'desc' ? 'desc' : 'asc';

        $items = $query->orderBy($sortBy, $sortDirection)->paginate(12);

        $items->getCollection()->transform(function ($item) {
            $item->status = $item->quantity == 0 ? 'Hết hàng'
                            : ($item->quantity < 10 ? 'Sắp hết hàng' : 'Còn hàng');
            return $item;
        });

        return response()->json([
            'data' => $items->items(),
            'pagination' => [
                'current_page' => $items->currentPage(),
                'last_page' => $items->lastPage(),
                'per_page' => $items->perPage(),
                'total' => $items->total(),
            ],
        ]);
    }

    // ✅ API chi tiết: dùng trong modal trên cùng 1 view
    public function showJson(string $product_id)
    {
        $product = Product::with('category')
            ->where('product_id', $product_id)
            ->firstOrFail();

        $product->status = $product->quantity == 0 ? 'Hết hàng'
                        : ($product->quantity < 10 ? 'Sắp hết hàng' : 'Còn hàng');

        $related = Product::where('category_id', $product->category_id)
            ->where('product_id', '!=', $product->product_id)
            ->limit(8)->get();

        return response()->json([
            'product' => $product,
            'related' => $related,
        ]);
    }
}
