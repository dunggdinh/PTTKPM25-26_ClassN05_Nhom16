<?php
namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\admin\Cart;
use App\Models\admin\CartItem;
use App\Models\admin\Discount;
use App\Models\admin\Product;
use App\Notifications\LowStockInCartNotification;

class CartController extends Controller
{
    // Lấy cart theo user. Nếu chưa có -> tạo
    protected function getOrCreateCart(string $userId): Cart
    {
        $cart = Cart::where('user_id', $userId)->first();
        if (!$cart) {
            $cart = Cart::create([
                'cart_id' => Cart::newId(),
                'user_id' => $userId,
            ]);
        }
        return $cart;
    }

    // Trang giỏ hàng (render Blade của cậu)
    public function index(Request $request)
    {
        $user = Auth::user();
        $userId = $user->user_id ?? null;

        if (!$userId) {
            return redirect()->route('customer.login')->with('error', 'Vui lòng đăng nhập để xem giỏ hàng');
        }

        // ✅ Lấy hoặc tạo giỏ hàng cho user
        $cart = $this->getOrCreateCart($userId);

        // ✅ Tải dữ liệu liên kết (cart_items + product)
        $cart->load('CartItem.product');

        // ✅ Tính tổng tiền (subtotal)
        $subtotal = $cart->CartItem->reduce(function ($carry, $item) {
            $price = $item->product->price ?? 0;
            return $carry + ($price * ($item->quantity ?? 1));
        }, 0);

        // ✅ VAT 10%
        $tax = $subtotal * 0.1;

        // ✅ Tổng cộng
        $total = $subtotal + $tax;

        // ✅ Lấy danh sách discount hợp lệ
        $discounts = $this->getActiveDiscounts();

        return view('customer.cart', [
            'cart' => $cart,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
            'discounts' => $discounts,
        ]);
    }
    protected function getActiveDiscounts()
    {
        $today = now()->toDateString(); // Lấy ngày hôm nay

        return Discount::where('status', 'Đang diễn ra')
            ->where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->get();
    }


    // Thêm vào giỏ
    public function addToCart(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Bạn cần đăng nhập trước khi thêm sản phẩm vào giỏ!'], 401);
        }

        $userId = Auth::id();
        $productId = $request->input('product_id');
        $quantity = max(1, intval($request->input('quantity', 1)));

        // ✅ Tìm hoặc tạo giỏ hàng cho user
        $cart = Cart::firstOrCreate(
            ['user_id' => $userId],
            ['cart_id' => 'CART_' . str_pad(Cart::count() + 1, 3, '0', STR_PAD_LEFT)]
        );

        // ✅ Kiểm tra nếu sản phẩm đã có trong giỏ thì tăng số lượng
        $item = CartItem::where('cart_id', $cart->cart_id)
                        ->where('product_id', $productId)
                        ->first();

        if ($item) {
            $item->quantity += $quantity;
            $item->save();
        } else {
            CartItem::create([
                'cart_item_id' => 'CI_' . str_pad(CartItem::count() + 1, 3, '0', STR_PAD_LEFT),
                'cart_id'      => $cart->cart_id,
                'product_id'   => $productId,
                'quantity'     => $quantity,
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Đã thêm sản phẩm vào giỏ hàng!']);
    }

    // Cập nhật số lượng
    public function updateItem(Request $request, string $cartItemId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $userId = Auth::user()->user_id;
        $cart   = $this->getOrCreateCart($userId);

        $item = CartItem::where('cart_item_id', $cartItemId)
                        ->where('cart_id', $cart->cart_id)
                        ->firstOrFail();

        $item->quantity = (int)$request->quantity;
        $item->save();

        return response()->json(['ok' => true]);
    }

    // Xóa item
    public function removeItem(Request $request, string $cartItemId)
    {
        $userId = Auth::user()->user_id;
        $cart   = $this->getOrCreateCart($userId);

        CartItem::where('cart_item_id', $cartItemId)
                ->where('cart_id', $cart->cart_id)
                ->delete();

        return response()->json(['ok' => true]);
    }

    // Xóa sạch giỏ
    public function clear(Request $request)
    {
        $userId = Auth::user()->user_id;
        $cart   = $this->getOrCreateCart($userId);

        CartItem::where('cart_id', $cart->cart_id)->delete();

        return response()->json(['ok' => true]);
    }

    // API trả về JSON để UI load động (nếu cậu muốn dùng fetch)
    public function data(Request $request)
    {
        $userId = Auth::user()->user_id;
        $cart   = $this->getOrCreateCart($userId);
        $items  = CartItem::with('product')
                    ->where('cart_id', $cart->cart_id)->get();

        $subtotal = $items->reduce(function($carry, $item){
            $price = $item->product->price ?? 0;
            return $carry + $price * ($item->quantity ?? 1);
        }, 0);

        return response()->json([
            'cart_id'  => $cart->cart_id,
            'items'    => $items->map(function($i){
                return [
                    'cart_item_id' => $i->cart_item_id,
                    'product_id'   => $i->product_id,
                    'name'         => $i->product->name ?? '',
                    'price'        => (float)($i->product->price ?? 0),
                    'quantity'     => (int)($i->quantity ?? 1),
                ];
            }),
            'subtotal' => (float)$subtotal,
        ]);
    }
    public function placeOrder(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Vui lòng đăng nhập']);
        }

        $cart = $this->getOrCreateCart($user->user_id);

        $items = CartItem::with('product')
            ->whereIn('cart_item_id', $request->items)
            ->where('cart_id', $cart->cart_id)
            ->get();

        if ($items->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'Không có sản phẩm hợp lệ']);
        }

        // Tạo order
        $orderId = 'O_' . uniqid();
        $totalAmount = $items->sum(fn($i) => $i->product->price * $i->quantity);

        $order = \App\Models\admin\Order::create([
            'order_id' => $orderId,
            'user_id' => $user->user_id,
            'total_amount' => $totalAmount,
            'status' => 1, // đã đặt
            'payment_status' => 0, // chưa thanh toán
            'shipping_address' => $user->address ?? '',
            'created_at' => now(),
        ]);

        // Lưu chi tiết đơn hàng
        foreach ($items as $item) {
            \App\Models\admin\OrderItem::create([
                'order_item_id' => 'OI_' . uniqid(),
                'order_id' => $orderId,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'unit_price' => $item->product->price,
            ]);
        }

        // Xóa sản phẩm đã đặt khỏi giỏ
        CartItem::whereIn('cart_item_id', $request->items)
            ->where('cart_id', $cart->cart_id)
            ->delete();

        return response()->json(['success' => true]);
    }

}
