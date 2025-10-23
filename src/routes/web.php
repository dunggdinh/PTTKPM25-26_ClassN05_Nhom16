<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

// Auth + Admin Controllers
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\ReturnController;
use App\Http\Controllers\admin\InventoryController;
use App\Http\Controllers\admin\WarrantyController;
use App\Http\Controllers\admin\DeliveryController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ReportController;
use App\Http\Controllers\admin\PaymentController;
use App\Http\Controllers\admin\NotificationController as AdminNotificationController;
use App\Http\Controllers\admin\DiscountController;


// Customer Controllers
use App\Http\Controllers\customer\GoogleController;
use App\Http\Controllers\customer\ProfileController;
use App\Http\Controllers\customer\ProductController;     // ✅ chỉ 1 import
use App\Http\Controllers\customer\CartController;
use App\Http\Controllers\customer\OrderController as CustomerOrderController;
use App\Http\Controllers\customer\PromotionController;
use App\Http\Controllers\customer\NotificationController;

use App\Http\Controllers\customer\VnpayController;


use App\Http\Controllers\admin\SupportConversationController;
use App\Http\Controllers\admin\SupportMessageController;

/*
|--------------------------------------------------------------------------
| PUBLIC / CUSTOMER PRODUCT
|--------------------------------------------------------------------------
*/

// /customer/product dùng Controller -> trả view có $products, $categories
Route::get('/customer/product', [ProductController::class, 'index'])
    ->name('customer.product');
 // ✅ chỉ 1 route này cho /customer/product

// Nhóm /products (API JSON dùng chung controller)
Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');                       // /products
    Route::get('/_list.json', [ProductController::class, 'listJson'])->name('json');           // /products/_list.json
    Route::get('/_show/{product_id}.json', [ProductController::class, 'showJson'])->name('show.json'); // /products/_show/{id}.json
});

/*
|--------------------------------------------------------------------------
| CART (top-level, yêu cầu đăng nhập)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/cart',              [CartController::class, 'index'])->name('cart');
    Route::get('/cart/data',         [CartController::class, 'data'])->name('cart.data');

    Route::post('/cart/add',         [CartController::class, 'addToCart'])->name('cart.add');
    Route::patch('/cart/item/{id}',  [CartController::class, 'updateItem'])->name('cart.update');
    Route::post('/cart/place-order', [CartController::class, 'placeOrder'])->name('cart.placeOrder');
    Route::delete('/cart/item/{id}', [CartController::class, 'removeItem'])->name('cart.remove');
    Route::delete('/cart/clear',     [CartController::class, 'clear'])->name('cart.clear');
    Route::post('/vnpay/create-payment', [VnpayController::class, 'createPayment'])->name('vnpay.create');
    Route::get('/vnpay/callback', [VnpayController::class, 'callback'])->name('vnpay.callback');
    Route::post('/vnpay/checkout', [VnpayController::class, 'createPayment'])->name('vnpay.create');


});


/*
|--------------------------------------------------------------------------
| CUSTOMER AREA (prefix /customer)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('customer')->name('customer.')->group(function () {
    // Home
    Route::view('/home', 'customer.home')->name('home');

    // Promotion động (ưu tiên Controller thay vì Route::view để tránh trùng /promotion)
    Route::get('/promotion', [PromotionController::class, 'index'])->name('promotion');
    Route::get('/vouchers/_active.json', [PromotionController::class, 'vouchersJson'])->name('vouchers.json');

    // Profile (gộp về một nơi, dùng show/update/password)
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    // Các trang tĩnh còn lại
    Route::view('/review', 'customer.review')->name('review');
    Route::get('/support/{conversation}', function (\App\Models\admin\SupportConversation $conversation) {
        return view('customer.support', compact('conversation'));
    })->name('support');
    // Route::view('/support', 'customer.support')->name('support');
});

/*
|--------------------------------------------------------------------------
| CUSTOMER ORDERS (đăng nhập)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Alias singular
    Route::get('/customer/order', [CustomerOrderController::class, 'index'])
        ->name('customer.order');

    // Plural list
    Route::get('/customer/orders', [CustomerOrderController::class, 'index'])
        ->name('customer.orders.index');

    // JSON chi tiết đơn cho modal
    Route::get('/customer/orders/{id}', [CustomerOrderController::class, 'show'])
        ->name('customer.orders.show');
});

/*
|--------------------------------------------------------------------------
| DEBUG AUTH
|--------------------------------------------------------------------------
*/
Route::get('/test-auth', function () {
    dd(Auth::user());
})->middleware('auth');

/*
|--------------------------------------------------------------------------
| ADMIN (prefix /admin)
|--------------------------------------------------------------------------
*/
// Route::prefix('admin')->name('admin.')->middleware(['auth','ensure.admin'])->group(function () {
Route::prefix('admin')->name('admin.')->group(function () {
    // Lưu ý: trong group đã có prefix name "admin.", bên trong đặt name ngắn gọn để tránh "admin.admin.*"
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route::view('/support', 'admin.support')->name('support');
    Route::get('/support/{conversation}', function (\App\Models\admin\SupportConversation $conversation) {
        return view('admin.support', compact('conversation'));
    })->name('support');

    // Promotion
    Route::get('/promotion',        [DiscountController::class, 'index'])->name('promotions');        // admin.promotions
    // API cho JS
    Route::get('/promotions/list',  [DiscountController::class, 'list'])->name('promotions.list');    // admin.promotions.list
    Route::post('/promotions',      [DiscountController::class, 'store'])->name('promotions.store');  // admin.promotions.store
    Route::put('/promotions/{id}',  [DiscountController::class, 'update'])->name('promotions.update');// admin.promotions.update
    Route::delete('/promotions/{id}', [DiscountController::class, 'destroy'])->name('promotions.destroy'); // admin.promotions.destroy
    // Customer
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/user/export', [UserController::class, 'exportExcel'])->name('user.export');
    Route::get('/user/reload', [UserController::class, 'reload'])->name('user.reload');

    // Deliveries
    Route::get('/deliveries', [DeliveryController::class, 'index'])->name('deliveries');
    Route::post('/deliveries', [DeliveryController::class, 'store'])->name('deliveries.store');
    Route::put('/deliveries/{id}/update-status', [DeliveryController::class, 'updateStatus'])->name('deliveries.updateStatus');
    Route::delete('/deliveries/{id}', [DeliveryController::class, 'destroy'])->name('deliveries.destroy');
    Route::get('/deliveries/export', [DeliveryController::class, 'exportExcel'])->name('deliveries.export');
    Route::get('/deliveries/reload', [DeliveryController::class, 'reload'])->name('deliveries.reload');

    // Inventory
    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory');
    // Giữ kiểu GET cho export để thống nhất pattern export tải file
    Route::get('/inventory/export', [InventoryController::class, 'export'])->name('inventory.export');
    Route::get('/inventory/reload', [InventoryController::class, 'reload'])->name('inventory.reload');

    // Orders
    Route::get('/order', [OrderController::class, 'index'])->name('order');
    Route::get('/order/export', [OrderController::class, 'exportExcel'])->name('order.export');
    Route::put('order/{id}/update-status', [OrderController::class, 'updateStatus'])->name('order.updateStatus');
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('order.destroy');
    Route::get('/order/reload', [OrderController::class, 'reload'])->name('order.reload');

    // Payments (Controller)
    Route::get('/payments_gateway', [PaymentController::class, 'index'])->name('payments_gateway');
    Route::get('/payments/verify/{id}', [PaymentController::class, 'verify'])->name('payments.verify');
    Route::get('/payments/reject/{id}', [PaymentController::class, 'reject'])->name('payments.reject');

    // Report (Controller)
    Route::get('/report', [ReportController::class, 'index'])->name('report');

    // Return & Warranty
    Route::get('/return', [ReturnController::class, 'index'])->name('return');
    Route::get('/warranties', [WarrantyController::class, 'index'])->name('warranties');
    Route::put('/warranties/{id}/update-status', [WarrantyController::class, 'updateStatus'])->name('warranties.updateStatus');
    Route::delete('/warranties/{id}', [WarrantyController::class, 'destroy'])->name('warranties.destroy');
    Route::get('/warranties/reload', [WarrantyController::class, 'reload'])->name('warranties.reload');

});

/*
|--------------------------------------------------------------------------
| AUTH (prefix /auth)
|--------------------------------------------------------------------------
*/
Route::prefix('auth')->name('auth.')->group(function () {
    // LOGIN
    Route::get('/login',    [AuthController::class,'showLoginForm'])->name('login');
    Route::post('/login',   [AuthController::class,'login'])->name('login.submit');

    // REGISTER
    Route::get('/register', [AuthController::class,'showRegisterForm'])->name('register');
    Route::post('/register',[AuthController::class,'register'])->name('register.submit');

    // FORGOT PASSWORD 
    Route::get('/reset_password',  [AuthController::class,'showResetForm'])->name('reset_password');
    Route::post('/reset_password', [AuthController::class,'handleReset'])->name('reset_password.submit');

    // LOGOUT
    Route::post('/logout', [AuthController::class,'logout'])->name('logout');
});

// Thêm
// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Nhóm route customer
// Route::prefix('customer')->group(function () {
//     Route::view('/home', 'customer.home'); ẩn cho vui 
// Route::prefix('customer')->name('customer.')->group(function () {
//     Route::view('/home', 'customer.home')->name('home');
//     Route::view('/promotion', 'customer.promotion');
//     //Route::view('/product', 'customer.product');
//     Route::view('/cart', 'customer.cart');
//     Route::view('/order', 'customer.order');
//     Route::view('/review', 'customer.review');
//     Route::view('/support', 'customer.support');
//     // Route::view('/profile', 'customer.profile'); Cmt để tránh ghi đè
// });

// Route::get('/profile', [ProfileController::class, 'show'])->name('customer.profile');
// Route::post('/profile', [ProfileController::class, 'update'])->name('customer.profile.update');
// Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('customer.profile.password');

// Serve static files

/*
|--------------------------------------------------------------------------
| STATIC FILES
|--------------------------------------------------------------------------
*/
Route::get('/css/app.css', function () {
    $path = resource_path('css/app.css');
    return Response::make(File::get($path), 200, ['Content-Type' => 'text/css']);
});
/*
|--------------------------------------------------------------------------
| SUPPORT CHAT API (auth)
|--------------------------------------------------------------------------
*/
// Route::middleware('auth')->group(function () {
Route::prefix('admin')->middleware('auth')->group(function () {
    // 1) Danh sách conversation
    Route::get('/conversations', [SupportConversationController::class, 'index'])
        ->name('conversations.index');

    // 2) Lấy lịch sử tin nhắn theo conversation
    Route::get('/conversations/{id}/messages', [SupportMessageController::class, 'index'])
        ->whereNumber('id')->name('conversations.messages.index');

    // 3) Gửi tin nhắn vào conversation
    Route::post('/conversations/{id}/messages', [SupportMessageController::class, 'store'])
        ->whereNumber('id')->name('conversations.messages.store');
});
/*
|--------------------------------------------------------------------------
| SUPPORT CHAT API (CUSTOMER)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // 1) Lấy danh sách tin nhắn theo conversation
    Route::get('/conversations/{id}/messages', [SupportMessageController::class, 'index'])
        ->whereNumber('id')
        ->name('customer.conversations.messages.index');

    // 2) Gửi tin nhắn mới
    Route::post('/conversations/{id}/messages', [SupportMessageController::class, 'store'])
        ->whereNumber('id')
        ->name('customer.conversations.messages.store');
});


/*
|--------------------------------------------------------------------------
| Notification
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/customer/notifications', [NotificationController::class, 'list'])->name('customer.notifications');
    Route::post('/customer/notifications/read-all', [NotificationController::class, 'markAllRead'])->name('customer.notifications.read_all');
    Route::post('/customer/notifications/{id}/read', [NotificationController::class, 'markOneRead'])->name('customer.notifications.read_one');
    Route::delete('/customer/notifications/{id}', [NotificationController::class, 'remove'])->name('customer.notifications.remove');
});

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/notifications',             [AdminNotificationController::class, 'list'])->name('admin.notifications');
    Route::post('/notifications/read-all',   [AdminNotificationController::class, 'markAllRead'])->name('admin.notifications.read_all');
    Route::post('/notifications/{id}/read',  [AdminNotificationController::class, 'markOneRead'])->name('admin.notifications.read_one');
    Route::delete('/notifications/{id}',     [AdminNotificationController::class, 'remove'])->name('admin.notifications.remove');
});






// Map
Route::get('/map', [GoogleController::class, 'showMap']);
Route::get('google-autocomplete', [GoogleController::class, 'index']);


// Save address route
Route::post('/save-address', [GoogleController::class, 'saveAddress'])->name('save-address');

Route::prefix('api/map')->group(function () {
    Route::get('/test', [GoogleController::class, 'index']);
    Route::get('/address-from-latlng', [GoogleController::class, 'getAddressFromLatLng']);
    Route::get('/search-address', [GoogleController::class, 'searchAddress']);
});