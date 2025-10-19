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
    /**
     * Hiển thị danh sách lô hàng nhập
     */
    public function index(Request $request)
    {
        $query = ImportBatch::with(['supplier', 'product']);

        // Tìm kiếm
        if ($request->filled('search')) {
            $query->where('batch_id', 'like', "%{$request->search}%");
        }

        // Lọc trạng thái
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Lọc nhà cung cấp
        if ($request->filled('supplier') && $request->supplier !== 'all') {
            $query->where('supplier_id', $request->supplier);
        }

        $batches = $query->orderBy('created_at', 'desc')->paginate(10);
        $suppliers = Supplier::all();

        // Thống kê
        $totalBatches = ImportBatch::count();
        $completedBatches = ImportBatch::where('status', 'completed')->count();
        $pendingBatches = ImportBatch::where('status', 'pending')->count();
        $totalValue = ImportBatch::sum('total_value');

        return view('admin.import.index', compact(
            'batches',
            'suppliers',
            'totalBatches',
            'completedBatches',
            'pendingBatches',
            'totalValue'
        ));
    }

    /**
     * Reload dữ liệu (AJAX)
     */
    public function reload()
    {
        // Lấy lại dữ liệu mới nhất
        $batches = ImportBatch::with(['supplier', 'product'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Thống kê mới nhất
        $totalBatches = ImportBatch::count();
        $completedBatches = ImportBatch::where('status', 'completed')->count();
        $pendingBatches = ImportBatch::where('status', 'pending')->count();
        $totalValue = ImportBatch::sum('total_value');

        // Nếu gọi bằng AJAX, trả về JSON
        return response()->json([
            'batches' => $batches,
            'stats' => [
                'totalBatches' => $totalBatches,
                'completedBatches' => $completedBatches,
                'pendingBatches' => $pendingBatches,
                'totalValue' => number_format($totalValue, 0, ',', '.'),
            ]
        ]);
    }

    /**
     * Hiển thị form thêm lô hàng mới
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $products = Product::all();
        return view('admin.import.create', compact('suppliers', 'products'));
    }

    /**
     * Lưu lô hàng mới
     */
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

        return redirect()->route('admin.import.index')->with('success', 'Thêm lô hàng thành công!');
    }

    /**
     * Xóa lô hàng
     */
    public function destroy($id)
    {
        ImportBatch::findOrFail($id)->delete();
        return back()->with('success', 'Xóa lô hàng thành công!');
    }

    /**
     * Xuất Excel
     */
    public function exportExcel()
    {
        return Excel::download(new ImportBatchExport, 'import_batches.xlsx');
    }
}
