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
use App\Http\Controllers\admin\DiscountController;
use App\Http\Controllers\admin\PromotionController as AdminPromotionController;

// Customer Controllers
use App\Http\Controllers\customer\GoogleController;
use App\Http\Controllers\customer\ProfileController;
use App\Http\Controllers\customer\ProductController;     // ✅ chỉ 1 import
use App\Http\Controllers\customer\CartController;
use App\Http\Controllers\customer\OrderController as CustomerOrderController;
use App\Http\Controllers\customer\PromotionController;
use App\Http\Controllers\customer\NotificationController;
use App\Http\Controllers\admin\SupportTicketController;
use App\Http\Controllers\customer\PromotionController as CustomerPromotionController;
use App\Http\Controllers\customer\ReviewController;
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
    Route::get('/create', [ProductController::class, 'create'])->name('create');               // Form thêm sản phẩm mới
    Route::post('/', [ProductController::class, 'store'])->name('store');                      // Lưu sản phẩm mới
    Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('edit');                // Form sửa sản phẩm
    Route::put('/{id}', [ProductController::class, 'update'])->name('update');                 // Cập nhật sản phẩm
    Route::delete('/{id}', [ProductController::class, 'destroy'])->name('destroy');            // Xóa sản phẩm
});


/*
|--------------------------------------------------------------------------
| CUSTOMER AREA (prefix /customer)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('customer')->name('customer.')->group(function () {
    // Home
    Route::view('/home', 'customer.home')->name('home');

    // ✅ Promotion (customer)
    Route::get('/promotion',                [CustomerPromotionController::class, 'index'])->name('promotion');
    Route::get('/vouchers/_active.json',    [CustomerPromotionController::class, 'vouchersJson'])->name('vouchers.json');

    // Profile (gộp về một nơi, dùng show/update/password)
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    // Các trang tĩnh còn lại
    Route::view('/review', 'customer.review')->name('review');
    
    Route::get('/cart',                   [CartController::class, 'index'])->name('cart.index');
    Route::get('/cart/data',              [CartController::class, 'data'])->name('cart.data');

    Route::post('/cart/add',              [CartController::class, 'addToCart'])->name('cart.add');

    // Cập nhật số lượng: DÙNG PATCH
    Route::patch('/cart/item/{id}',       [CartController::class, 'updateItem'])->name('cart.item.update');

    // Xóa 1 item: DÙNG DELETE
    Route::delete('/cart/item/{id}',      [CartController::class, 'removeItem'])->name('cart.item.remove');

    // Xóa toàn bộ: DÙNG DELETE
    Route::delete('/cart/clear',          [CartController::class, 'clear'])->name('cart.clear');

    // Đặt hàng: CHUẨN HÓA endpoint này
    Route::post('/cart/place', [CartController::class, 'placeOrder'])->name('cart.place');
 

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

    // Route::post('/cart/add',          [CartController::class, 'addToCart'])->name('customer.cart.add');
    // Route::post('/cart/update/{id}',  [CartController::class, 'updateItem'])->name('customer.cart.update');
    // Route::post('/cart/remove/{id}',  [CartController::class, 'removeItem'])->name('customer.cart.remove');
    // Route::post('/cart/clear',        [CartController::class, 'clear'])->name('customer.cart.clear');
    // Route::get('/cart/data',          [CartController::class, 'data'])->name('customer.cart.data');
});

/*
|--------------------------------------------------------------------------
| DEBUG AUTH
|--------------------------------------------------------------------------
*/
Route::get('/test-auth', function () {
    dd(Auth::user());
})->middleware('auth');

/* ============================================================
| ADMIN PROMOTION (dùng AdminPromotionController)
|============================================================*/
Route::middleware(['auth'])
    ->prefix('admin/promotion')->name('admin.promotion.')
    ->group(function () {
        Route::get('/',              [AdminPromotionController::class, 'index'])->name('index');    // trang Blade admin
        Route::get('/list',          [AdminPromotionController::class, 'list'])->name('list');      // JSON cho bảng
        Route::post('/',             [AdminPromotionController::class, 'store'])->name('store');    // tạo
        Route::put('/{id}',          [AdminPromotionController::class, 'update'])->name('update');  // cập nhật
        Route::patch('/{id}/toggle', [AdminPromotionController::class, 'toggle'])->name('toggle');  // bật/tạm dừng
        Route::delete('/{id}',       [AdminPromotionController::class, 'destroy'])->name('destroy');// xoá
    });

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

    // Customer
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/user/export', [UserController::class, 'exportExcel'])->name('user.export');
    Route::get('/user/reload', [UserController::class, 'reload'])->name('user.reload');

    // Deliveries
    Route::get('/deliveries', [DeliveryController::class, 'index'])->name('deliveries');
    Route::post('/deliveries', [DeliveryController::class, 'store'])->name('deliveries.store');
    Route::get('/deliveries/{id}/edit', [DeliveryController::class, 'edit'])->name('deliveries.edit');
    Route::put('/deliveries/{id}', [DeliveryController::class, 'update'])->name('deliveries.update');
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


    // Report (Controller)
    Route::get('/report', [ReportController::class, 'index'])->name('report');

    // Return & Warranty
    Route::get('/return', [ReturnController::class, 'index'])->name('return');
    Route::get('/warranties', [WarrantyController::class, 'index'])->name('warranties');
    Route::put('/warranties/{id}/update-status', [WarrantyController::class, 'updateStatus'])->name('warranties.updateStatus');
    Route::delete('/warranties/{id}', [WarrantyController::class, 'destroy'])->name('warranties.destroy');
    Route::get('/warranties/reload', [WarrantyController::class, 'reload'])->name('warranties.reload');

    Route::get('admin/promotion/list', [PromotionController::class, 'list'])->name('admin.promotion.list');
    Route::post('admin/promotion', [PromotionController::class, 'store'])->name('admin.promotion.store');
    Route::put('admin/promotion/{id}', [PromotionController::class, 'update'])->name('admin.promotion.update');
    Route::post('admin/promotion/{id}/toggle', [PromotionController::class, 'toggle'])->name('admin.promotion.toggle');
    Route::delete('admin/promotion/{id}', [PromotionController::class, 'destroy'])->name('admin.promotion.destroy');


});

Route::get('/admin/promotion/stats', [App\Http\Controllers\admin\PromotionController::class, 'stats'])
    ->name('admin.promotion.stats');
Route::post('/admin/promotion/{id}/toggle', [\App\Http\Controllers\admin\PromotionController::class, 'toggle'])
    ->name('admin.promotion.toggle');

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
| SUPPORT CHAT (Kênh chung, gần real-time)
|-------------------------------------------------------------------------- 
*/

Route::middleware(['auth'])->group(function () {
    // ✅ ADMIN SIDE
    Route::prefix('admin')->group(function () {
        // Route::get('/support', function () {
        //     return view('admin.support');
        // })->name('admin.support');
        Route::get('/support', [SupportTicketController::class, 'index'])->name('admin.support');

        Route::get('/support/messages', [SupportMessageController::class, 'index'])
            ->name('admin.support.messages');

        Route::post('/support/messages', [SupportMessageController::class, 'store'])
            ->name('admin.support.messages.store');
    });
    // ✅ CUSTOMER SIDE
    Route::prefix('customer')->group(function () {
        Route::get('/support', function () {
            return view('customer.support');
        })->name('customer.support');

        Route::get('/support/messages', [SupportMessageController::class, 'index'])
            ->name('customer.support.messages');

        Route::post('/support/messages', [SupportMessageController::class, 'store'])
            ->name('customer.support.messages.store');
    });
});


// Save address route
Route::post('/save-address', [GoogleController::class, 'saveAddress'])->name('save-address');

Route::prefix('api/map')->group(function () {
    Route::get('/test', [GoogleController::class, 'index']);
    Route::get('/address-from-latlng', [GoogleController::class, 'getAddressFromLatLng']);
    Route::get('/search-address', [GoogleController::class, 'searchAddress']);
});

Route::middleware(['web','auth'])->group(function () {
    // Trang review (render Blade của cậu)
    Route::get('/reviews', [ReviewController::class, 'index'])->name('customer.reviews.index');

    // Tạo review (AJAX/POST form)
    Route::post('/reviews', [ReviewController::class, 'store'])->name('customer.reviews.store');

    // API list review (lọc/sắp xếp/phân trang cho phần danh sách)
    Route::get('/reviews/_list.json', [ReviewController::class, 'list'])->name('customer.reviews.list');

    // API sản phẩm đã mua – còn “đủ điều kiện” review
    Route::get('/customer/reviews/eligible', [ReviewController::class, 'eligible'])
        ->name('customer.reviews.eligible');
});