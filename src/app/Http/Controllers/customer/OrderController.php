<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\admin\Order;
use App\Notifications\OrderConfirmedNotification;

class OrderController extends Controller
{
    // Danh sách đơn của user
    public function index(Request $request)
    {
        $user = Auth::user();
        if (!$user || !$user->user_id) {
            return redirect()->route('customer.login')
                ->with('error', 'Vui lòng đăng nhập để xem đơn hàng');
        }

        // Lọc theo status nếu có: processing | shipping | delivered
        $status = $request->query('status'); // 'processing','shipping','delivered' hoặc null

        $ordersQ = Order::with(['orderItems.product'])
            ->where('user_id', $user->user_id)
            ->orderBy('created_at', 'desc');

        if ($status && in_array($status, ['processing','shipping','delivered'])) {
            // map text UI -> text DB nếu khác
            $map = [
                'processing' => 'Chờ xử lý',     // tùy cách cậu lưu trong DB
                'shipping'   => 'Đang giao',      // ví dụ
                'delivered'  => 'Đã giao',        // ví dụ
            ];
            $ordersQ->where('status', $map[$status] ?? $status);
        }

        $orders = $ordersQ->get();

        // Chuẩn hóa dữ liệu nhẹ cho view (tính tổng nếu cần)
        $orders->transform(function($o){
            // Nếu total_amount đã lưu sẵn thì giữ; nếu chưa, tính từ items:
            if (is_null($o->total_amount) || $o->total_amount == 0) {
                $o->total_amount = $o->orderItems->sum(function($it){
                    return (int)$it->unit_price * (int)$it->quantity;
                });
            }
            return $o;
        });

        // Trả về Blade
        return view('customer.order', compact('orders'));
    }

    // Chi tiết đơn (JSON cho modal)
    public function show($id)
    {
        $user = Auth::user();
        if (!$user || !$user->user_id) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $order = Order::with(['orderItems.product'])
            ->where('user_id', $user->user_id)
            ->where('order_id', $id)
            ->firstOrFail();

        // build payload gọn cho JS
        $payload = [
            'id'      => $order->order_id,
            'date'    => optional($order->created_at)->format('d/m/Y'),
            'status'  => $order->status,
            'total'   => (int)$order->total_amount,
            'address' => $order->shipping_address,
            'phone'   => $order->customer->phone ?? '',
            'items'   => $order->orderItems->map(function($it){
                return [
                    'name'   => $it->product->name ?? ('SP#'.$it->product_id),
                    'price'  => (int)$it->unit_price,
                    'qty'    => (int)$it->quantity,
                    'variant'=> [
                        // nếu có cột màu/bộ nhớ lưu ở order_items, map vào đây
                        'color'   => $it->product->color ?? '',
                        'storage' => $it->product->storage ?? '',
                    ]
                ];
            })->values(),
        ];

        return response()->json($payload);
    }

    public function confirm($orderId) {
        $order = Order::with('user')->findOrFail($orderId);
        // ... logic xác nhận

        $order->user->notify(new OrderConfirmedNotification($order->order_code, $order->product_name));
        // ...
    }
}
