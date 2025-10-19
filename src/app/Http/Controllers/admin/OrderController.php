<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Order;
use App\Models\admin\OrderItem;
use App\Models\admin\Customer;
use App\Models\admin\Product;
use App\Exports\OrderExport;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    /**
     * Hiển thị danh sách đơn hàng với tìm kiếm, lọc, thống kê
     */
    public function index(Request $request)
    {
        // Sửa lại quan hệ đúng với model bạn có
        $query = Order::with(['Customer', 'OrderItems.product']);

        // 🔍 Tìm kiếm theo mã đơn hoặc tên khách hàng
        if ($request->has('search') && !empty($request->search)) {
            $search = strtolower($request->search);
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(order_id) LIKE ?', ["%{$search}%"])
                  ->orWhereHas('Customer', function ($sub) use ($search) {
                      $sub->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"]);
                  });
            });
        }

        // 🔖 Lọc theo trạng thái
        if ($request->has('status') && $request->status != '' && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        // ⏰ Lọc theo thời gian (ngày đặt)
        if ($request->filled('date')) {
            if ($request->date === 'today') {
                $query->whereDate('created_at', today());
            } elseif ($request->date === 'week') {
                $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
            } elseif ($request->date === 'month') {
                $query->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year);
            }
        }


        // 📋 Phân trang
        $orders = $query->orderBy('created_at', 'desc')
                        ->paginate(10)
                        ->withQueryString();

        // 📊 Thống kê
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'Chờ xử lý')->count();
        $completedOrders = Order::where('status', 'Đã giao')->count();
        $revenue = Order::where('status', 'Đã giao')->sum('total_amount');

        return view('admin.order', compact(
            'orders', 'totalOrders', 'pendingOrders', 'completedOrders', 'revenue'
        ));
    }

    /**
     * ✅ Cập nhật trạng thái đơn hàng
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string'
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }

    /**
     * ❌ Xóa đơn hàng
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->back()->with('success', 'Xóa đơn hàng thành công!');
    }

    /**
     * ⬇ Xuất danh sách đơn hàng ra Excel
     */
    public function exportExcel()
    {
        return Excel::download(new OrderExport, 'orders.xlsx');
    }

    /**
     * 🔄 Tải lại danh sách đơn hàng (không lọc)
     */
    public function reload()
    {
        $orders = Order::with(['customer', 'orderItems.product'])
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'Chờ xử lý')->count();
        $completedOrders = Order::where('status', 'Đã giao')->count();
        $revenue = Order::where('status', 'Đã giao')->sum('total_amount');

        return view('admin.order', compact(
            'orders', 'totalOrders', 'pendingOrders', 'completedOrders', 'revenue'
        ));
    }
    public function show($id)
    {
        // Lấy đơn hàng cùng với thông tin khách hàng và các sản phẩm trong đơn
        $order = Order::with(['customer', 'orderItems.product'])
                    ->where('order_id', $id)
                    ->firstOrFail();

        return view('admin.order_show', compact('order'));
    }
}
