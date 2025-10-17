<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Model Product để tương tác với bảng products
use Maatwebsite\Excel\Facades\Excel; // Package để xuất Excel/CSV
use App\Exports\InventoryExport; // Class Export (sẽ được tạo)
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    /**
     * Hiển thị trang quản lý tồn kho
     */
    public function index()
    {
        // Lấy thống kê
        $totalProducts = Product::count();
        $lowStock = Product::where('stock', '<=', DB::raw('min_stock'))->where('stock', '>', 0)->count();
        $outOfStock = Product::where('stock', 0)->count();
        $inStock = $totalProducts - $lowStock - $outOfStock;

        // Danh sách danh mục (có thể lấy từ DB hoặc hardcode)
        $categories = [
            'smartphone' => 'Điện thoại',
            'laptop' => 'Laptop',
            'tablet' => 'Tablet',
            'accessory' => 'Phụ kiện',
        ];

        return view('inventory', compact('totalProducts', 'lowStock', 'outOfStock', 'inStock', 'categories'));
    }

    /**
     * API: Lấy danh sách sản phẩm với bộ lọc
     */
    public function getProducts(Request $request)
    {
        $query = Product::query();

        // Bộ lọc tìm kiếm
        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
        }

        // Bộ lọc danh mục
        if ($category = $request->input('category')) {
            $query->where('category', $category);
        }

        // Bộ lọc trạng thái
        if ($status = $request->input('status')) {
            if ($status === 'in-stock') {
                $query->where('stock', '>', DB::raw('min_stock'));
            } elseif ($status === 'low-stock') {
                $query->where('stock', '<=', DB::raw('min_stock'))->where('stock', '>', 0);
            } elseif ($status === 'out-of-stock') {
                $query->where('stock', 0);
            }
        }

        $products = $query->get()->map(function ($product) {
            // Cập nhật trạng thái động
            $product->status = $this->determineStatus($product->stock, $product->min_stock);
            return $product;
        });

        return response()->json($products);
    }

    /**
     * API: Lấy danh sách cảnh báo tồn kho
     */
    public function getAlerts()
    {
        $alerts = Product::where('stock', '<=', DB::raw('min_stock'))->get()->map(function ($product) {
            $product->status = $this->determineStatus($product->stock, $product->min_stock);
            return $product;
        });

        return response()->json($alerts);
    }

    /**
     * API: Lấy chi tiết sản phẩm
     */
    public function getProductDetails($id)
    {
        $product = Product::findOrFail($id);
        $product->status = $this->determineStatus($product->stock, $product->min_stock);
        return response()->json($product);
    }

    /**
     * API: Cập nhật tồn kho sản phẩm
     */
    public function updateStock(Request $request, $id)
    {
        $request->validate([
            'stock' => 'required|integer|min:0',
            'min_stock' => 'required|integer|min:0',
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'stock' => $request->stock,
            'min_stock' => $request->min_stock,
            'last_updated' => now(),
            'status' => $this->determineStatus($request->stock, $request->min_stock),
        ]);

        return response()->json([
            'message' => 'Cập nhật tồn kho thành công',
            'product' => $product
        ]);
    }

    /**
     * API: Xóa sản phẩm
     */
    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $productName = $product->name;
        $product->delete();

        return response()->json(['message' => "Xóa sản phẩm '$productName' thành công"]);
    }

    /**
     * API: Xuất dữ liệu ra Excel/CSV
     */
    public function export(Request $request)
    {
        $request->validate([
            'range' => 'required|in:all,current,selected',
            'format' => 'required|in:xlsx,csv',
            'file_name' => 'required|string|max:255',
            'include_headers' => 'boolean',
            'include_timestamp' => 'boolean',
            'include_stats' => 'boolean',
            'statuses' => 'array',
            'columns' => 'array',
            'selected_ids' => 'array|required_if:range,selected',
        ]);

        $fileName = $request->file_name . '-' . now()->format('Y-m-d') . '.' . $request->format;

        return Excel::download(new InventoryExport($request->all()), $fileName);
    }

    /**
     * Helper: Xác định trạng thái sản phẩm
     */
    private function determineStatus($stock, $minStock)
    {
        if ($stock == 0) {
            return 'out-of-stock';
        } elseif ($stock <= $minStock) {
            return 'low-stock';
        }
        return 'in-stock';
    }
}