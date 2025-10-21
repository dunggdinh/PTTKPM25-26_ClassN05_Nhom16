<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Order;
use App\Models\admin\OrderItem;
use App\Models\admin\User;
use App\Models\admin\Product;
use App\Exports\OrderExport;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        // Sửa lại quan hệ đúng với model bạn có
        $query = Order::with(['User', 'OrderItems.product']);

        // 🔍 Tìm kiếm theo mã đơn hoặc tên khách hàng
        if ($request->has('search') && !empty($request->search)) {
            $search = strtolower($request->search);
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(order_id) LIKE ?', ["%{$search}%"])
                  ->orWhereHas('User', function ($sub) use ($search) {
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


        $sortBy = $request->get('sort_by', 'order_id');
        $sortDirection = $request->get('sort_direction', 'asc');

        $orders = $query->orderBy($sortBy, $sortDirection)
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


    public function show($id)
    {
        // Lấy đơn hàng cùng với thông tin khách hàng và các sản phẩm trong đơn
        $order = Order::with(['user', 'orderItems.product'])
                    ->where('order_id', $id)
                    ->firstOrFail();

        return view('admin.order_show', compact('order'));
    }
    public function reload()
    {
        $orders = Order::with(['user', 'orderItems.product'])
                    ->orderBy('created_at', 'desc')
                    ->get();

        $html = '';

        foreach ($orders as $order) {

            // Trạng thái với màu
            $statusColors = [
                'pending' => 'bg-yellow-100 text-yellow-800',
                'processing' => 'bg-blue-100 text-blue-800',
                'shipped' => 'bg-purple-100 text-purple-800',
                'delivered' => 'bg-green-100 text-green-800',
                'cancelled' => 'bg-red-100 text-red-800',
            ];
            $statusClass = $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800';

            // Các sản phẩm trong đơn
            $itemsHtml = '';
            foreach ($order->orderItems as $item) {
                $productName = $item->product->name ?? 'Sản phẩm không tồn tại';
                $itemsHtml .= "<div>{$productName} (x{$item->quantity})</div>";
            }

            $html .= "
                <tr class='hover:bg-gray-50 transition'>
                    <td class='px-6 py-4 text-sm font-medium text-gray-900'>{$order->order_id}</td>
                    <td class='px-6 py-4 text-sm text-gray-700'>".($order->customer->name ?? 'Không xác định')."</td>
                    <td class='px-6 py-4 text-sm text-gray-700'>{$itemsHtml}</td>
                    <td class='px-6 py-4 text-sm text-gray-700'>".number_format($order->total_amount, 0, ',', '.')." ₫</td>
                    <td class='px-6 py-4 text-sm'>
                        <span class='px-3 py-1 rounded-full text-xs font-semibold {$statusClass}'>".ucfirst($order->status)."</span>
                    </td>
                    <td class='px-6 py-4 text-sm text-gray-700'>{$order->shipping_address}</td>
                    <td class='px-6 py-4 text-sm text-gray-700'>".\Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i')."</td>
                    <td class='px-6 py-4 text-sm text-gray-700'>
                        <a href='".route('admin.order.show', $order->order_id)."' class='text-blue-600 hover:underline'>Xem</a>
                        <form action='".route('admin.order.destroy', $order->order_id)."' method='POST' onsubmit='return confirm(\"Xóa đơn hàng này?\")' class='inline'>
                            ".csrf_field().method_field('DELETE')."
                            <button type='submit' class='text-red-600 hover:underline'>Xóa</button>
                        </form>
                    </td>
                </tr>
            ";
        }

        if ($orders->isEmpty()) {
            $html = "<tr><td colspan='8' class='text-center py-6 text-gray-500'>Không có đơn hàng nào.</td></tr>";
        }

        return response()->json(['html' => $html]);
    }

}
