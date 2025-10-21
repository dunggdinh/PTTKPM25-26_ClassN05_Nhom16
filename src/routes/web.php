<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\ReturnController; // 
use App\Http\Controllers\admin\InventoryController;
use App\Http\Controllers\admin\WarrantyController;
use App\Http\Controllers\admin\DeliveryController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\customer\ProfileController;
use App\Http\Controllers\customer\ProductController; // ✅ CHỈ 1 import, không alias
use App\Http\Controllers\admin\ReportController;
use App\Http\Controllers\admin\PaymentController;


// /customer/product dùng Controller -> trả view có $products, $categories
Route::get('/user/product', [ProductController::class, 'index'])
    ->name('user.product'); // ✅ chỉ 1 route này cho /customer/product

// Nhóm /products (có thể dùng chung controller)
Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');              // /products
    Route::get('/_list.json', [ProductController::class, 'listJson'])->name('json'); // /products/_list.json
    Route::get('/_show/{product_id}.json', [ProductController::class, 'showJson'])->name('show.json'); // /products/_show/{id}.json
});




Route::get('/test-auth', function () {
    dd(Auth::user());
})->middleware('auth');

Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('user.profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('user.profile.update');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('user.profile.password');
});

// Nhóm route admin 
#Route::prefix('admin')->name('admin.')->middleware(['auth','ensure.admin'])->group(function () {
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::view('/support', 'admin.support')->name('support');

    Route::get('/user', [UserController::class, 'index'])->name('user'); // danh sách
    Route::get('/user/export', [UserController::class, 'exportExcel'])->name('user.export');
    Route::get('/user/reload', [UserController::class, 'reload'])->name('user.reload');

    Route::get('/deliveries', [DeliveryController::class, 'index'])->name('deliveries');
    Route::post('/deliveries', [DeliveryController::class, 'store'])->name('deliveries.store');
    Route::put('/deliveries/{id}', [DeliveryController::class, 'update'])->name('deliveries.update');
    Route::delete('/deliveries/{id}', [DeliveryController::class, 'destroy'])->name('deliveries.destroy');
    Route::get('/deliveries/export', [DeliveryController::class, 'exportExcel'])->name('deliveries.export');
    Route::get('/deliveries/reload', [DeliveryController::class, 'reload'])->name('deliveries.reload');

    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory');
    Route::post('/inventory/export', [InventoryController::class, 'export'])->name('inventory.export');
    Route::get('/inventory/reload', [InventoryController::class, 'reload'])->name('inventory.reload');

    Route::get('/order', [OrderController::class, 'index'])->name('order');
    Route::get('/order/export', [OrderController::class, 'exportExcel'])->name('order.export');
    Route::put('/order/{id}/update-status', [OrderController::class, 'updateStatus'])->name('order.updateStatus');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('order.show');
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('order.destroy');
    Route::get('/order/reload', [OrderController::class, 'reload'])->name('order.reload');

    // Route::get('/payments-gateway', [PaymentController::class, 'index'])->name('admin.payments_gateway');
    // Route::get('/payments_gateway', [PaymentController::class, 'index'])->name('admin.payments_gateway');
    // Route::get('/payments/verify/{id}', [PaymentController::class, 'verify'])->name('admin.payments.verify');
    // Route::get('/payments/reject/{id}', [PaymentController::class, 'reject'])->name('admin.payments.reject');
    Route::get('/payments_gateway', [PaymentController::class, 'index'])->name('payments_gateway');
    Route::get('/payments/verify/{id}', [PaymentController::class, 'verify'])->name('payments.verify');
    Route::get('/payments/reject/{id}', [PaymentController::class, 'reject'])->name('payments.reject');
    // Route::view('/report', 'admin.report')->name('report');
    Route::get('/report', [ReportController::class, 'index'])->name('report');
    // Route::view('/return', 'admin.return')->name('return');
    Route::get('/return', [ReturnController::class, 'index'])->name('admin.return'); // mới để kết nối đến Controller và Returncontroller
    // Route::view('/warranties', 'admin.warranties')->name('warranties');
    Route::get('/warranties', [WarrantyController::class, 'index'])->name('admin.warranties');
});
Route::prefix('auth')->name('auth.')->group(function () {
    // LOGIN
    Route::get('/login',  [AuthController::class,'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class,'login'])->name('login.submit');

    // REGISTER
    Route::get('/register',  [AuthController::class,'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class,'register'])->name('register.submit');

    // FORGOT PASSWORD 
    Route::get('/reset_password',  [AuthController::class,'showResetForm'])->name('reset_password');
    Route::post('/reset_password', [AuthController::class,'handleReset'])->name('reset_password.submit');

    // LOGOUT (nếu có dùng)
    Route::post('/logout', [AuthController::class,'logout'])->name('logout');

});


// Nhóm route customer
// Route::prefix('customer')->group(function () {
//     Route::view('/home', 'customer.home'); ẩn cho vui 
Route::prefix('customer')->name('customer.')->group(function () {
    Route::view('/home', 'customer.home')->name('home');
    Route::view('/promotion', 'customer.promotion');
    //Route::view('/product', 'customer.product');
    Route::view('/cart', 'customer.cart');
    Route::view('/order', 'customer.order');
    Route::view('/review', 'customer.review');
    Route::view('/support', 'customer.support');
    Route::view('/profile', 'customer.profile');
});

// Serve static files
Route::get('/css/app.css', function () {
    $path = resource_path('css/app.css');
    return Response::make(File::get($path), 200, [
        'Content-Type' => 'text/css'
    ]);
});


// Payment routes
Route::get('/checkout', function () {
    return view('checkout');
});
Route::post('/vnpay-payment', [PaymentController::class, 'createPayment']);
Route::get('/vnpay-return', [PaymentController::class, 'returnPayment']);



