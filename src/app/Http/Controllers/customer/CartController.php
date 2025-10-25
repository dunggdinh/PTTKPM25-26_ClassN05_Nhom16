<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\Models\admin\Cart;
use App\Models\admin\CartItem;
use App\Models\admin\Discount;
use App\Models\admin\Product;
use App\Models\admin\Order;
use App\Models\admin\OrderItem;

class CartController extends Controller
{
    /** Lấy hoặc tạo cart cho user */
    protected function getOrCreateCart(string $userId): Cart
    {
        return Cart::firstOrCreate(
            ['user_id' => $userId],
            ['user_id' => $userId]
        );
    }

    /** Trang giỏ hàng */
    public function index(Request $request)
    {
        $user = Auth::user();
        $userId = $user->user_id ?? null;
        if (!$userId) {
            return redirect()->route('customer.login')->with('error', 'Vui lòng đăng nhập để xem giỏ hàng');
        }

        $cart = $this->getOrCreateCart($userId);
        $cart->load('CartItem.product');

        $subtotal = $cart->CartItem->reduce(function ($carry, $item) {
            $price = (float)($item->product->price ?? 0);
            $qty   = (int)($item->quantity ?? 1);
            return $carry + ($price * $qty);
        }, 0.0);

        $tax   = $subtotal * 0.10; // VAT 10%
        $total = $subtotal + $tax;

        $discounts = $this->getActiveDiscounts();

        return view('customer.cart', [
            'cart'      => $cart,
            'subtotal'  => $subtotal,
            'tax'       => $tax,
            'total'     => $total,
            'discounts' => $discounts,
        ]);
    }

    /** Lọc discount hợp lệ theo ngày */
    protected function getActiveDiscounts()
    {
        $today = now()->toDateString();

        return Discount::query()
            ->where('status', 'Đang diễn ra')
            ->where(function ($q) use ($today) {
                $q->whereNull('start_date')->orWhere('start_date', '<=', $today);
            })
            ->where(function ($q) use ($today) {
                $q->whereNull('end_date')->orWhere('end_date', '>=', $today);
            })
            ->orderBy('end_date', 'asc')
            ->get();
    }

    /** Thêm vào giỏ (AJAX) */
    public function addToCart(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Bạn cần đăng nhập trước khi thêm sản phẩm vào giỏ!'], 401);
        }

        $request->validate([
            'product_id' => 'required|string',
            'quantity'   => 'nullable|integer|min:1',
        ]);

        $user   = Auth::user();
        $userId = $user->user_id;
        $productId = $request->input('product_id');
        $quantity  = max(1, (int)$request->input('quantity', 1));

        /** kiểm tra sản phẩm tồn tại */
        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Sản phẩm không tồn tại'], 404);
        }

        $cart = $this->getOrCreateCart($userId);

        $item = CartItem::where('cart_id', $cart->cart_id)
                        ->where('product_id', $productId)
                        ->first();

        if ($item) {
            $item->quantity = (int)$item->quantity + $quantity;
            $item->save();
        } else {
            CartItem::create([
                'cart_id'      => $cart->cart_id,
                'product_id'   => $productId,
                'quantity'     => $quantity,
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Đã thêm sản phẩm vào giỏ hàng!']);
    }

    /** Cập nhật số lượng */
    public function updateItem(Request $request, string $cartItemId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $user   = Auth::user();
        $cart   = $this->getOrCreateCart($user->user_id);

        $item = CartItem::where('cart_item_id', $cartItemId)
                        ->where('cart_id', $cart->cart_id)
                        ->firstOrFail();

        $item->quantity = (int)$request->quantity;
        $item->save();

        return response()->json(['ok' => true]);
    }

    /** Xóa 1 item khỏi giỏ */
    public function removeItem(Request $request, string $cartItemId)
    {
        $user = Auth::user();
        $cart = $this->getOrCreateCart($user->user_id);

        CartItem::where('cart_item_id', $cartItemId)
                ->where('cart_id', $cart->cart_id)
                ->delete();

        return response()->json(['ok' => true]);
    }

    /** Xóa sạch giỏ */
    public function clear(Request $request)
    {
        $user = Auth::user();
        $cart = $this->getOrCreateCart($user->user_id);

        CartItem::where('cart_id', $cart->cart_id)->delete();

        return response()->json(['ok' => true]);
    }

    /** API JSON cho UI fetch */
    public function data(Request $request)
    {
        $user = Auth::user();
        $cart = $this->getOrCreateCart($user->user_id);

        $items = CartItem::with('product')
            ->where('cart_id', $cart->cart_id)
            ->get();

        $subtotal = $items->reduce(function ($carry, $i) {
            $price = (float)($i->product->price ?? 0);
            $qty   = (int)($i->quantity ?? 1);
            return $carry + ($price * $qty);
        }, 0.0);

        return response()->json([
            'cart_id'  => $cart->cart_id,
            'items'    => $items->map(function ($i) {
                return [
                    'cart_item_id' => $i->cart_item_id,
                    'product_id'   => $i->product_id,
                    'name'         => (string)($i->product->name ?? ''),
                    'price'        => (float)($i->product->price ?? 0),
                    'quantity'     => (int)($i->quantity ?? 1),
                    'thumbnail'    => (string)($i->product->thumbnail ?? ''), // nếu có
                ];
            }),
            'subtotal' => (float)$subtotal,
        ]);
    }

    /**
     * Đặt hàng (AJAX hoặc form POST)
     * Yêu cầu:
     * - items: array cart_item_id muốn checkout (nếu rỗng: checkout tất cả)
     * - shipping_address_json (optional, JSON từ localStorage)
     */
    public function placeOrder(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Vui lòng đăng nhập'], 401);
        }

        $request->validate([
            'items' => 'nullable|array',
            'items.*' => 'string',
            'shipping_address_json' => 'nullable|string'
        ]);

        $cart = $this->getOrCreateCart($user->user_id);

        // Lấy items cần đặt: theo danh sách client gửi, nếu không có => toàn bộ giỏ
        $query = CartItem::with('product')->where('cart_id', $cart->cart_id);
        if ($request->filled('items')) {
            $query->whereIn('cart_item_id', $request->items);
        }
        $items = $query->get();

        if ($items->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'Không có sản phẩm hợp lệ'], 422);
        }

        // Parse địa chỉ từ localStorage (nếu có)
        $addr = null;
        if ($request->filled('shipping_address_json')) {
            $parsed = json_decode($request->input('shipping_address_json'), true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $addr = $parsed;
            }
        }

        // Tính tiền server-side
        $subtotal = $items->reduce(function ($sum, $i) {
            $price = (float)($i->product->price ?? 0);
            $qty   = (int)($i->quantity ?? 1);
            return $sum + ($price * $qty);
        }, 0.0);
        $tax   = $subtotal * 0.10;
        $total = $subtotal + $tax;

        // Tạo Order trong transaction
        try {
            DB::beginTransaction();

            $order = Order::create([
                // KHÔNG truyền order_id, boot() của Model Order sẽ tự sinh (ORD_***)
                'user_id'          => $user->user_id,
                'total_amount'     => $total,
                'subtotal_amount'  => $subtotal,
                'tax_amount'       => $tax,
                'status'           => 'Đang xử lý',                 // tuỳ quy ước: 1 = chờ xử lý
                // GIỮ thuộc tính như cũ: chỉ đổi giá trị payment_status thành chuỗi an toàn
                // vì cột của bạn đang là VARCHAR/ENUM → truyền số 0 gây “Data truncated”
                'payment_status'   => 'Chưa thanh toán', // ← quan trọng: bỏ số 0
                // (nếu bảng có cột payment_method thì set cứng)
                'payment_method'   => 'COD',
                'shipping_name'    => $addr['address_name'] ?? null,
                'shipping_address' => trim(
                    ($addr['address_detail'] ?? '') . ' ' .
                    ($addr['district'] ?? '') . ' ' .
                    ($addr['city'] ?? '')
                ) ?: ($user->address ?? ''),
                'shipping_phone'   => $addr['phone'] ?? ($user->phone ?? null),
                // nếu $timestamps=false trong model thì bổ sung created_at thủ công:
                // 'created_at'       => now(),
            ]);

$orderId = $order->order_id;

            foreach ($items as $item) {
                OrderItem::create([
                    'order_item_id' => \App\Models\admin\OrderItem::newId(),
                    'order_id'      => $order->order_id,
                    'product_id'    => $item->product_id,
                    'quantity'      => (int)$item->quantity,
                    'unit_price'    => (float)($item->product->price ?? 0),
                ]);
            }

            // Xóa các cart item đã đặt
            $deleteQuery = CartItem::where('cart_id', $cart->cart_id);
            if ($request->filled('items')) {
                $deleteQuery->whereIn('cart_item_id', $request->items);
            }
            $deleteQuery->delete();

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            dd($e->getMessage());
        }

        return response()->json([
            'success'  => true,
            'message'  => 'Đặt hàng thành công',
            'order_id' => $order->order_id,
        ]);
    }
}
