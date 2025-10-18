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
        $query = Delivery::query();

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

        $deliveries = $query->paginate(10);

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

        try {
            Delivery::create($validated);
            return redirect()->route('admin.deliveries.index')->with('success', 'Thêm lô hàng thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi thêm lô hàng. Vui lòng thử lại!');
        }
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

        try {
            $delivery->update($validated);
            return redirect()->route('admin.deliveries.index')->with('success', 'Cập nhật lô hàng thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi cập nhật lô hàng. Vui lòng thử lại!');
        }
    }

    /**
     * Remove the specified delivery from storage.
     */
    public function destroy($id)
    {
        $delivery = Delivery::findOrFail($id);

        try {
            $delivery->delete();
            return redirect()->route('admin.deliveries.index')->with('success', 'Xóa lô hàng thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi xóa lô hàng. Vui lòng thử lại!');
        }
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

        $query = Delivery::query();

        if ($dataRange === 'selected') {
            $selectedIds = $request->input('selectedIds', []);
            if (empty($selectedIds)) {
                return redirect()->back()->with('error', 'Không có lô hàng nào được chọn!');
            }
            $query->whereIn('id', $selectedIds);
        } elseif ($dataRange === 'current') {
            $currentPageIds = $request->input('currentPageIds', []);
            if (empty($currentPageIds)) {
                return redirect()->back()->with('error', 'Không có dữ liệu trên trang hiện tại!');
            }
            $query->whereIn('id', $currentPageIds);
        }

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

        if ($includeTimestamp) {
            $fileName .= '-' . now()->format('Y-m-d_H-i-s');
        }
        $fileName .= '.' . $fileFormat;

        try {
            return Excel::download(new DeliveriesExport($deliveries, $columns, $includeHeader, $includeStats), $fileName);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi xuất file. Vui lòng thử lại!');
        }
    }
<<<<<<< HEAD
} 
=======
}
>>>>>>> 5129d7191c85fb2d2be517ddc3b0e1fcd655d58e
