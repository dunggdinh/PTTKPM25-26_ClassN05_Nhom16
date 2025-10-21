<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Product;
use App\Models\admin\Category;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InventoryExport;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'supplier']);
        $categories = Category::all();

        // 🔹 Lọc theo danh mục
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // 🔹 Lọc theo trạng thái
        if ($request->filled('status')) {
            if ($request->status === 'in-stock') {
                $query->where('quantity', '>=', 10);
            } elseif ($request->status === 'low-stock') {
                $query->whereBetween('quantity', [1, 9]);
            } elseif ($request->status === 'out-of-stock') {
                $query->where('quantity', 0);
            }
        }

        // 🔹 Tìm kiếm theo tên, brand, product_id
        if ($request->filled('search')) {
            $search = strtolower($request->search);
            $query->where(function($q) use ($search) {
                $q->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"])
                ->orWhereRaw('LOWER(brand) LIKE ?', ["%{$search}%"])
                ->orWhereRaw('LOWER(product_id) LIKE ?', ["%{$search}%"]);
            });
        }

        // 🔹 Sắp xếp
        $sortBy = $request->get('sort_by', 'product_id');
        $sortDirection = $request->get('sort_direction', 'asc');

        $products = $query->orderBy($sortBy, $sortDirection)
                        ->paginate(10)
                        ->withQueryString();
        // Thống kê
        $totalProducts = Product::count(); // Tổng sản phẩm
        $inStock = Product::where('quantity', '>=', 10)->count(); // Còn hàng
        $lowStock = Product::where('quantity', '>', 0)->where('quantity', '<', 10)->count(); // Sắp hết hàng
        $outOfStock = Product::where('quantity', 0)->count(); // Hết hàng

        $lowStockProducts = Product::where('quantity', '>', 0)->where('quantity', '<', 10)->get();
        $outOfStockProducts = Product::where('quantity', 0)->get();

        $phones = Product::whereHas('category', function ($q) {
            $q->where('name', 'Điện thoại di động');
        })->get();

        $laptops = Product::whereHas('category', function ($q) {
            $q->where('name', 'Laptop');
        })->get();


        return view('admin.inventory', compact(
            'products','categories', 'totalProducts', 'inStock', 'lowStock', 'outOfStock','lowStockProducts','outOfStockProducts', 'phones', 'laptops'
        ));
        }


    public function reload()
    {
        $products = product::with('category', 'supplier')
            ->orderBy('name', 'asc')
            ->get();

        // Render phần tbody bằng Blade string (không cần view mới)
        $html = '';
        foreach ($products as $product) {
            $status = $product->quantity == 0
                ? '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">Hết hàng</span>'
                : ($product->quantity < 10
                    ? '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-700">Sắp hết</span>'
                    : '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">Còn hàng</span>');

            $html .= "
                <tr class='hover:bg-gray-50 transition'>
                    <td class='px-6 py-4 text-sm text-gray-900 font-medium'>{$product->product_id}</td>
                    <td class='px-6 py-4 text-sm text-gray-900'>{$product->name}</td>
                    <td class='px-6 py-4 text-sm text-gray-900'>{$product->brand}</td>
                    <td class='px-6 py-4 text-sm text-gray-900'>".($product->category->name ?? '—')."</td>
                    <td class='px-6 py-4 text-sm text-gray-900'>{$product->quantity}</td>
                    <td class='px-6 py-4 text-sm'>{$status}</td>
                    <td class='px-6 py-4 text-sm text-gray-900'>".number_format($product->price, 0, ',', '.')."₫</td>
                    <td class='px-6 py-4 text-sm text-gray-900'>{$product->warranty}</td>
                    <td class='px-6 py-4 text-sm text-gray-900'>".($product->supplier->name ?? '—')."</td>
                    <td class='px-6 py-4 text-sm'>
                        <div class='flex space-x-2'>
                            <a href='".route('admin.inventory.update', $product->product_id)."' class='text-blue-600 hover:text-blue-800 font-medium'>Sửa</a>
                            <form action='".route('admin.inventory.destroy', $product->product_id)."' method='POST' onsubmit='return confirm(\"Xóa sản phẩm này?\")'>
                                ".csrf_field().method_field('DELETE')."
                                <button type='submit' class='text-red-600 hover:text-red-800 font-medium'>Xóa</button>
                            </form>
                        </div>
                    </td>
                </tr>
            ";
        }

        if ($products->isEmpty()) {
            $html = "<tr><td colspan='10' class='px-6 py-4 text-center text-gray-500 text-sm'>Không có sản phẩm nào.</td></tr>";
        }

        return response()->json(['html' => $html]);
    }


    public function export(Request $request)
    {
        $columns = $request->columns 
            ? json_decode($request->columns, true) 
            : ['product_id','name','brand','category','quantity','status','price','warranty','supplier'];

        $format = $request->format ?? 'xlsx';
        $fileName = ($request->fileName ?? 'inventory-export') . '-' . now()->format('Y-m-d') . '.' . $format;

        return Excel::download(new InventoryExport($columns), $fileName);
    }

}
