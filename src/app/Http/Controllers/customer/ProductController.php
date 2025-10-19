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

        // lọc theo category_id nếu có (?category=abc hoặc ?category=all)
        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category_id', $request->category);
        }

        // search
        if ($request->filled('search')) {
            $search = mb_strtolower(trim($request->search));
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(brand) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(product_id) LIKE ?', ["%{$search}%"]);
            });
        }

        // sort
        $allowedSorts = ['name', 'price', 'brand', 'created_at'];
        $sortBy = in_array($request->get('sort_by'), $allowedSorts) ? $request->get('sort_by') : 'name';
        $sortDirection = $request->get('sort_direction') === 'desc' ? 'desc' : 'asc';

        $products = $query->orderBy($sortBy, $sortDirection)
            ->paginate(12)
            ->withQueryString();

        // trạng thái tồn kho
        $products->getCollection()->transform(function ($p) {
            $p->status = $p->quantity == 0 ? 'Hết hàng' : ($p->quantity < 10 ? 'Sắp hết hàng' : 'Còn hàng');
            return $p;
        });

        // ✅ BẮT BUỘC: truyền $categories sang view
        $categories = Category::select('category_id', 'name')->get();

        // ✅ Trả đúng view đang dùng
        return view('customer.product', compact('products', 'categories', 'sortBy', 'sortDirection'));
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
