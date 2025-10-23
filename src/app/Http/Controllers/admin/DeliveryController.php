<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Product;
use App\Models\admin\Supplier;
use App\Models\admin\ImportBatch;
use App\Models\admin\Category;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ImportBatchExport;
use Illuminate\Support\Str;

class DeliveryController extends Controller
{
    public function index(Request $request)
    {
        $query = ImportBatch::with(['supplier', 'product']);

        // 🔍 Tìm kiếm theo batch_id, tên nhà cung cấp hoặc tên sản phẩm
        if ($request->filled('search')) {
            $search = strtolower($request->search);
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(batch_id) LIKE ?', ["%{$search}%"])
                  ->orWhereHas('supplier', function ($sub) use ($search) {
                      $sub->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"]);
                  })
                  ->orWhereHas('product', function ($sub) use ($search) {
                      $sub->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"]);
                  });
            });
        }

        // 🔖 Lọc theo trạng thái (không phân biệt hoa thường)
        if ($request->filled('status')) {
            $status = strtolower($request->status);
            $query->whereRaw('LOWER(status) = ?', [$status]);
        }


        // 🔖 Lọc theo nhà cung cấp
        if ($request->filled('supplier')) {
            $query->where('supplier_id', $request->supplier);
        }

        $sortBy = $request->get('sort_by', 'batch_id');
        $sortDirection = $request->get('sort_direction', 'asc');

        $batches = $query->orderBy($sortBy, $sortDirection)
                         ->paginate(10)
                         ->withQueryString();

        $suppliers = Supplier::all();

        // 📊 Thống kê
        $totalBatches = ImportBatch::count();
        
        // Đếm số lô hàng đã hoàn thành (đã nhập kho)
        $completedBatches = ImportBatch::where('status', 'Hoàn thành')->count();
        
        // Đếm số lô hàng đang chờ xử lý
        $pendingBatches = ImportBatch::where('status', 'Chờ xử lý')->count();
        
        // Tính tổng giá trị của tất cả lô hàng đã hoàn thành
        $totalValue = ImportBatch::where('status', 'Hoàn thành')
            ->sum('total_value');

        // Lấy danh sách sản phẩm cho form tạo mới
        $products = Product::all();
        $categories = Category::all();

        return view('admin.deliveries', compact(
            'batches',
            'suppliers',
            'products',
            'categories',
            'totalBatches',
            'completedBatches',
            'pendingBatches',
            'totalValue'
        ));
    }

    /**
     * Reload dữ liệu AJAX
     */
    public function reload()
    {
        $batches = ImportBatch::with(['supplier', 'product'])
            ->orderBy('created_at', 'desc')
            ->get();

        $html = '';

        foreach ($batches as $batch) {
            $statusColors = [
                'Chờ xử lý' => 'bg-yellow-100 text-yellow-800',
                'Hoàn thành' => 'bg-green-100 text-green-800',
                'Đã hủy' => 'bg-red-100 text-red-800',
            ];
            $statusClass = $statusColors[$batch->status] ?? 'bg-gray-100 text-gray-800';

            $html .= "
                <tr class='hover:bg-gray-50 transition'>
                    <td class='px-6 py-4 text-sm font-medium text-gray-900'>{$batch->batch_id}</td>
                    <td class='px-6 py-4 text-sm text-gray-700'>".($batch->supplier->name ?? 'Không xác định')."</td>
                    <td class='px-6 py-4 text-sm text-gray-700'>".($batch->product->name ?? 'Không xác định')."</td>
                    <td class='px-6 py-4 text-sm text-gray-700'>{$batch->quantity}</td>
                    <td class='px-6 py-4 text-sm text-gray-700'>".number_format($batch->price, 0, ',', '.')." ₫</td>
                    <td class='px-6 py-4 text-sm'>
                        <span class='px-3 py-1 rounded-full text-xs font-semibold {$statusClass}'>".ucfirst($batch->status)."</span>
                    </td>
                    <td class='px-6 py-4 text-sm text-gray-700'>".number_format($batch->total_value, 0, ',', '.')." ₫</td>
                    <td class='px-6 py-4 text-sm text-gray-700'>
                        <a href='".route('admin.import.edit', $batch->id)."' class='text-blue-600 hover:underline'>Sửa</a>
                        <form action='".route('admin.import.destroy', $batch->id)."' method='POST' onsubmit='return confirm(\"Xóa lô hàng này?\")' class='inline'>
                            ".csrf_field().method_field('DELETE')."
                            <button type='submit' class='text-red-600 hover:underline'>Xóa</button>
                        </form>
                    </td>
                </tr>
            ";
        }

        if ($batches->isEmpty()) {
            $html = "<tr><td colspan='8' class='text-center py-6 text-gray-500'>Không có lô hàng nào.</td></tr>";
        }

        return response()->json(['html' => $html]);
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $products = Product::all();
        return view('admin.deliveries.create', compact('suppliers', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,supplier_id',
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,category_id',
            'quantity' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:0'
        ]);

        // Kiểm tra xem supplier_id có tồn tại không
        $supplier = Supplier::findOrFail($request->supplier_id);

        // Tạo sản phẩm mới - product_id sẽ được tự động tạo bởi Model boot()
        $product = Product::create([
            'name' => $request->product_name,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'quantity' => 0,  // Số lượng ban đầu là 0
            'price' => $request->price,
            'rating' => 0,    // Giá trị mặc định cho rating
            'warranty' => 12  // Giá trị mặc định cho warranty (tháng)
        ]);

        // Tạo lô hàng mới - batch_id sẽ được tự động tạo bởi Model boot()
        $batch = ImportBatch::create([
            'supplier_id' => $request->supplier_id,
            'product_id' => $product->product_id, // Sử dụng ID của sản phẩm vừa tạo
            'quantity' => $request->quantity,
            'price' => $request->price,
            'status' => 'Chờ xử lý', // Mặc định là Chờ xử lý
            'total_value' => $request->quantity * $request->price
        ]);

        return redirect()->route('admin.deliveries')->with('success', 'Thêm sản phẩm và lô hàng mới thành công!');
    }

    public function destroy($id)
    {
        ImportBatch::findOrFail($id)->delete();
        return back()->with('success', 'Xóa lô hàng thành công!');
    }

    public function exportExcel()
    {
        return Excel::download(new ImportBatchExport, 'import_batches.xlsx');
    }
    public function updateStatus(Request $request, $batchId)
    {
        $request->validate([
            'status' => 'required|in:Chờ xử lý,Hoàn thành,Đã hủy',
        ]);

        $batch = ImportBatch::findOrFail($batchId);
        $oldStatus = $batch->status;
        $batch->status = $request->status;
        
        // Nếu chuyển sang trạng thái Hoàn thành
        if ($request->status === 'Hoàn thành' && $oldStatus !== 'Hoàn thành') {
            $product = Product::find($batch->product_id);
            if ($product) {
                $product->quantity += $batch->quantity;
                $product->save();
            }
        }
        // Nếu từ Hoàn thành chuyển sang trạng thái khác
        else if ($oldStatus === 'Hoàn thành' && $request->status !== 'Hoàn thành') {
            $product = Product::find($batch->product_id);
            if ($product) {
                $product->quantity -= $batch->quantity;
                $product->save();
            }
        }

        $batch->save();

        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công.');
    }

    public function edit($id)
    {
        $batch = ImportBatch::findOrFail($id);
        $suppliers = Supplier::all();
        $products = Product::all();
        return view('admin.deliveries.edit', compact('batch', 'suppliers', 'products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,supplier_id',
            'product_id' => 'required|exists:products,product_id',
            'quantity' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $batch = ImportBatch::findOrFail($id);
        
        // Lưu thông tin cũ trước khi cập nhật
        $oldQuantity = $batch->quantity;
        $oldProductId = $batch->product_id;
        $oldStatus = $batch->status;

        // Cập nhật thông tin lô hàng
        $batch->supplier_id = $request->supplier_id;
        $batch->product_id = $request->product_id;
        $batch->quantity = $request->quantity;
        $batch->price = $request->price;
        $batch->total_value = $request->quantity * $request->price;
        
        // Nếu lô hàng đã hoàn thành, cập nhật số lượng trong kho
        if ($batch->status === 'Hoàn thành') {
                // Nếu sản phẩm thay đổi
            if ($oldProductId != $request->product_id) {
                // Trừ số lượng từ sản phẩm cũ
                $oldProduct = Product::find($oldProductId);
                if ($oldProduct) {
                    $oldProduct->quantity -= $oldQuantity;
                    $oldProduct->save();
                }
                
                // Cộng số lượng vào sản phẩm mới
                $newProduct = Product::find($request->product_id);
                $newProduct->quantity += $request->quantity;
                $newProduct->save();
            } else {
                // Nếu chỉ thay đổi số lượng
                $product = Product::find($request->product_id);
                $product->quantity = $product->quantity - $oldQuantity + $request->quantity;
                $product->save();
            }
        }

        $batch->save();

        return redirect()->route('admin.deliveries')->with('success', 'Cập nhật lô hàng thành công!');
    }
}
