<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Product;
use App\Models\admin\Supplier;
use App\Models\admin\ImportBatch;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ImportBatchExport;

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
        $completedBatches = ImportBatch::where('status', 'completed')->count();
        $pendingBatches = ImportBatch::where('status', 'pending')->count();
        $totalValue = ImportBatch::sum('total_value');

        return view('admin.deliveries', compact(
            'batches',
            'suppliers',
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
            'batch_id' => 'required|unique:import_batches,batch_id',
            'supplier_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        ImportBatch::create([
            'batch_id' => $request->batch_id,
            'supplier_id' => $request->supplier_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'status' => $request->status ?? 'pending',
            'total_value' => $request->quantity * $request->price,
        ]);

        return redirect()->route('admin.deliveries')->with('success', 'Thêm lô hàng thành công!');
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
        $batch->status = $request->status;
        $batch->save();

        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công.');
    }

}
