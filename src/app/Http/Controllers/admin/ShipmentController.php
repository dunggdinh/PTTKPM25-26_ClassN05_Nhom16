<?php


namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    // Hiển thị danh sách lô hàng
    public function index()
    {
        $shipments = Shipment::all();
        return view('deliveries', compact('shipments'));
    }

    // Thêm lô hàng mới
    public function store(Request $request)
    {
        $validated = $request->validate([
            'shipment_code' => 'required|unique:shipments',
            'supplier' => 'required',
            'product' => 'required',
            'quantity' => 'required|integer',
            'value' => 'required|integer',
            'date' => 'required|date',
            'notes' => 'nullable|string'
        ]);

        Shipment::create($validated);

        return response()->json(['message' => 'Đã thêm lô hàng mới thành công!']);
    }

    // Xem chi tiết lô hàng
    public function show($id)
    {
        $shipment = Shipment::findOrFail($id);
        return response()->json($shipment);
    }

    // Cập nhật lô hàng
    public function update(Request $request, $id)
    {
        $shipment = Shipment::findOrFail($id);

        $validated = $request->validate([
            'supplier' => 'required',
            'product' => 'required',
            'quantity' => 'required|integer',
            'value' => 'required|integer',
            'date' => 'required|date',
            'status' => 'required|in:pending,completed,cancelled',
            'notes' => 'nullable|string'
        ]);

        $shipment->update($validated);

        return response()->json(['message' => 'Đã cập nhật lô hàng thành công!']);
    }

    // Xóa lô hàng
    public function destroy($id)
    {
        $shipment = Shipment::findOrFail($id);
        $shipment->delete();

        return response()->json(['message' => 'Đã xóa lô hàng thành công!']);
    }

    // Xuất dữ liệu
    public function export(Request $request)
    {
        // 
    }
}