<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DeliveriesExport;
use Illuminate\Support\Facades\DB;

class DeliveryController extends Controller
{
    /**
     * Display a listing of deliveries.
     */
    public function index(Request $request)
    {
        // Query deliveries với filters
        $query = Delivery::query();

        // Filter by search
        if ($search = $request->input('search')) {
            $query->where('code', 'like', "%$search%")
                  ->orWhere('supplier', 'like', "%$search%")
                  ->orWhere('product', 'like', "%$search%");
        }

        // Filter by status
        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        // Filter by supplier
        if ($supplier = $request->input('supplier')) {
            $query->where('supplier', $supplier);
        }

        // Phân trang (10 items per page)
        $deliveries = $query->paginate(10);

        // Stats for dashboard cards
        $totalDeliveries = Delivery::count();
        $completedDeliveries = Delivery::where('status', 'completed')->count();
        $pendingDeliveries = Delivery::where('status', 'pending')->count();
        $totalValue = Delivery::sum('value');

        return view('admin.deliveries', compact(
            'deliveries',
            'totalDeliveries',
            'completedDeliveries',
            'pendingDeliveries',
            'totalValue'
        ));
    }

    /**
     * Show the form for creating a new delivery.
     */
    public function create()
    {
        // Danh sách nhà cung cấp để hiển thị trong dropdown
        $suppliers = ['Samsung Electronics', 'Apple Inc.', 'Xiaomi Corp.', 'Sony Corporation'];
        return view('admin.deliveries.create', compact('suppliers'));
    }

    /**
     * Store a newly created delivery in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|unique:deliveries,code',
            'supplier' => 'required',
            'product' => 'required',
            'quantity' => 'required|integer|min:1',
            'value' => 'required|numeric|min:0',
            'date' => 'required|date',
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        Delivery::create($validated);

        return redirect()->route('admin.deliveries.index')->with('success', 'Thêm lô hàng thành công!');
    }

    /**
     * Show the form for editing the specified delivery.
     */
    public function edit($id)
    {
        $delivery = Delivery::findOrFail($id);
        $suppliers = ['Samsung Electronics', 'Apple Inc.', 'Xiaomi Corp.', 'Sony Corporation'];
        return view('admin.deliveries.edit', compact('delivery', 'suppliers'));
    }

    /**
     * Update the specified delivery in storage.
     */
    public function update(Request $request, $id)
    {
        $delivery = Delivery::findOrFail($id);

        $validated = $request->validate([
            'code' => 'required|unique:deliveries,code,' . $id,
            'supplier' => 'required',
            'product' => 'required',
            'quantity' => 'required|integer|min:1',
            'value' => 'required|numeric|min:0',
            'date' => 'required|date',
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        $delivery->update($validated);

        return redirect()->route('admin.deliveries.index')->with('success', 'Cập nhật lô hàng thành công!');
    }

    /**
     * Remove the specified delivery from storage.
     */
    public function destroy($id)
    {
        $delivery = Delivery::findOrFail($id);
        $delivery->delete();

        return redirect()->route('admin.deliveries.index')->with('success', 'Xóa lô hàng thành công!');
    }

    /**
     * Export deliveries to Excel or CSV.
     */
    public function export(Request $request)
    {
        $fileFormat = $request->input('fileFormat', 'xlsx');
        $dataRange = $request->input('dataRange', 'all');
        $columns = $request->input('columns', []);
        $fileName = $request->input('fileName', 'danh-sach-lo-hang');
        $includeTimestamp = $request->boolean('includeTimestamp', true);
        $includeHeader = $request->boolean('includeHeader', true);
        $includeStats = $request->boolean('includeStats', false);

        if (empty($columns)) {
            return redirect()->back()->with('error', 'Vui lòng chọn ít nhất một cột để xuất!');
        }

        // Query dữ liệu dựa trên dataRange
        $query = Delivery::query();

        if ($dataRange === 'selected') {
            $selectedIds = $request->input('selectedIds', []);
            if (empty($selectedIds)) {
                return redirect()->back()->with('error', 'Không có lô hàng nào được chọn!');
            }
            $query->whereIn('id', $selectedIds);
        } elseif ($dataRange === 'current') {
            // Lấy dữ liệu từ trang hiện tại
            $query->whereIn('id', $request->input('currentPageIds', []));
        }

        // Áp dụng các bộ lọc nếu có
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('code', 'like', "%$search%")
                  ->orWhere('supplier', 'like', "%$search%")
                  ->orWhere('product', 'like', "%$search%");
            });
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        if ($supplier = $request->input('supplier')) {
            $query->where('supplier', $supplier);
        }

        $deliveries = $query->get();

        if ($deliveries->isEmpty()) {
            return redirect()->back()->with('error', 'Không có dữ liệu để xuất!');
        }

        // Tạo tên file
        if ($includeTimestamp) {
            $fileName .= '-' . now()->format('Y-m-d');
        }
        $fileName .= '.' . $fileFormat;

        // Xuất file sử dụng Maatwebsite\Excel
        return Excel::download(new DeliveriesExport($deliveries, $columns, $includeHeader, $includeStats), $fileName);
    }
}