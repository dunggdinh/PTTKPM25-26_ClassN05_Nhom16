<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Product;
use App\Models\admin\Category;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');


        // Lấy danh mục để hiển thị dropdown
        $categories = category::all();

        // Lọc theo danh mục nếu có
        if ($request->has('category') && $request->category != 'all') {
            $query->where('category_id', $request->category);
        }

        // Tìm kiếm theo tên, brand hoặc product_id
        if ($request->has('search') && !empty($request->search)) {
            $search = strtolower($request->search);
            $query->where(function($q) use ($search) {
                $q->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"])
                  ->orWhereRaw('LOWER(brand) LIKE ?', ["%{$search}%"])
                  ->orWhereRaw('LOWER(product_id) LIKE ?', ["%{$search}%"]);
            });
        }

        // Sắp xếp
        $sortBy = $request->get('sort_by', 'name');
        $sortDirection = $request->get('sort_direction', 'asc');
        $products = $query->orderBy($sortBy, $sortDirection)
                        ->paginate(10)
                        ->withQueryString();

        // Thêm trạng thái
        $products->transform(function ($item) {
            $item->status = $item->quantity == 0 ? 'Hết hàng'
                              : ($item->quantity < 10 ? 'Sắp hết hàng' : 'Còn hàng');
            return $item;
        });

        // Thống kê
        $totalProducts = Product::count(); // Tổng sản phẩm
        $inStock = Product::where('quantity', '>=', 10)->count(); // Còn hàng
        $lowStock = Product::where('quantity', '>', 0)->where('quantity', '<', 10)->count(); // Sắp hết hàng
        $outOfStock = Product::where('quantity', 0)->count(); // Hết hàng

        return view('admin.inventory', compact(
            'products', 'categories', 'totalProducts', 'inStock', 'lowStock', 'outOfStock'
        ));
    }

    /**
     * Thêm sản phẩm mới
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|string|unique:products,product_id',
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'category_id' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'warranty' => 'nullable|string',
        ]);

        product::create($request->all());

        return redirect()->back()->with('success', 'Thêm sản phẩm thành công!');
    }

    /**
     * Cập nhật sản phẩm
     */
    public function update(Request $request, $id)
    {
        $product = product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'category_id' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'warranty' => 'nullable|string',
        ]);

        $product->update($request->all());

        return redirect()->back()->with('success', 'Cập nhật sản phẩm thành công!');
    }

    /**
     * Xóa sản phẩm
     */
    public function destroy($id)
    {
        $product = product::findOrFail($id);
        $product->delete();

        return redirect()->back()->with('success', 'Xóa sản phẩm thành công!');
    }

    public function exportExcel()
    {
        return Excel::download(new InventoryExport, 'inventorys.xlsx');
    }

    public function reload()
    {
        $query = product::with('category');

        // Lấy danh mục để hiển thị dropdown
        $categories = category::all();

        // Không lọc, không tìm kiếm — chỉ tải lại toàn bộ

        // Sắp xếp mặc định
        $sortBy = 'name';
        $sortDirection = 'asc';
        $products = $query->orderBy($sortBy, $sortDirection)
                        ->paginate(10);

        // Thêm trạng thái tồn kho
        $products->transform(function ($item) {
            $item->status = $item->quantity == 0
                ? 'Hết hàng'
                : ($item->quantity < 10 ? 'Sắp hết hàng' : 'Còn hàng');
            return $item;
        });

        // Thống kê
        $totalProducts = product::count(); // Tổng sản phẩm
        $inStock = product::where('quantity', '>=', 10)->count(); // Còn hàng
        $lowStock = product::where('quantity', '>', 0)
                            ->where('quantity', '<', 10)
                            ->count(); // Sắp hết hàng
        $outOfStock = product::where('quantity', 0)->count(); // Hết hàng

        return view('admin.inventory', compact(
            'products',
            'categories',
            'totalProducts',
            'inStock',
            'lowStock',
            'outOfStock'
        ));
    }


}
