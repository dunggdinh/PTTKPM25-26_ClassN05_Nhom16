<?php
namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\admin\Cart;
use App\Models\admin\CartItem;
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
        $user = Auth::user(); // yêu cầu user đã đăng nhập
        $userId = $user->user_id ?? null;

        if (!$userId) {
            return redirect()->route('customer.login')->with('error','Vui lòng đăng nhập để xem giỏ hàng');
        }

        $cart = $this->getOrCreateCart($userId);
        $cart->load('items.product');

        // Tính tổng tiền từ price sản phẩm trong bảng products (cột price) 
        // (theo schema DB) 
        $subtotal = $cart->items->reduce(function($carry, $item) {
            $price = $item->product->price ?? 0;
            return $carry + ($price * ($item->quantity ?? 1));
        }, 0);

        return view('customer.cart', [
            'cart' => $cart,
            'subtotal' => $subtotal,
        ]);
    }

    // Thêm vào giỏ
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|string|exists:products,product_id',
            'quantity'   => 'nullable|integer|min:1',
        ]);

        $userId = Auth::user()->user_id;
        $cart   = $this->getOrCreateCart($userId);

        $qty = (int)($request->quantity ?? 1);

        // Nếu item đã tồn tại thì cộng dồn, ngược lại tạo mới
        $item = CartItem::where('cart_id', $cart->cart_id)
                        ->where('product_id', $request->product_id)
                        ->first();

        if ($item) {
            $item->quantity += $qty;
            $item->save();
        } else {
            CartItem::create([
                'cart_item_id' => CartItem::newId(),
                'cart_id'      => $cart->cart_id,
                'product_id'   => $request->product_id,
                'quantity'     => $qty,
            ]);
        }

        return response()->json(['ok' => true, 'message' => 'Đã thêm vào giỏ']);
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
}
