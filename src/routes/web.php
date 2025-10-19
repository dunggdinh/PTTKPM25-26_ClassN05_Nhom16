<?php
//                      ĐÂY LÀ CODE MỚI
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\admin\CustomerController;

use App\Http\Controllers\admin\InventoryController;

// routes/api.php
use App\Http\Controllers\TrackingController;
Route::get('/tracking/{trackingId}', [TrackingController::class, 'show']);


// Nhóm route admin 
#Route::prefix('admin')->name('admin.')->middleware(['auth','ensure.admin'])->group(function () {
Route::prefix('admin')->name('admin.')->group(function () {
    Route::view('/dashboard', 'admin.dashboard')->name('dashboard');
    Route::view('/support', 'admin.support')->name('support');

    Route::get('/customer', [CustomerController::class, 'index'])->name('customer'); // danh sách
    Route::get('/customer/export', [CustomerController::class, 'exportExcel'])->name('customer.export');
    Route::get('/customer/reload', [CustomerController::class, 'reload'])->name('customer.reload');

    Route::view('/deliveries', 'admin.deliveries')->name('deliveries');
    // Danh sách sản phẩm, phân trang, tìm kiếm, sắp xếp
    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory');

    // Thêm sản phẩm
    Route::post('/inventory', [InventoryController::class, 'store'])->name('inventory.store');

    // Cập nhật sản phẩm
    Route::put('/inventory/{id}', [InventoryController::class, 'update'])->name('inventory.update');

    // Xóa sản phẩm
    Route::delete('/inventory/{id}', [InventoryController::class, 'destroy'])->name('inventory.destroy');
    Route::get('/inventory/export', [InventoryController::class, 'exportExcel'])->name('inventory.export');
    Route::get('/inventory/reload', [InventoryController::class, 'reload'])->name('inventory.reload');

    // Trang danh sách đơn hàng (lọc, tìm kiếm, thống kê)
    Route::get('/order', [OrderController::class, 'index'])->name('order');

    // Cập nhật trạng thái đơn hàng
    Route::put('/order/{id}/update-status', [OrderController::class, 'updateStatus'])->name('order.updateStatus');

    // Xóa đơn hàng
    Route::delete('/order/{id}', [OrderController::class, 'destroy'])->name('order.destroy');

    // Xuất danh sách ra Excel
    Route::get('/order/export', [OrderController::class, 'exportExcel'])->name('order.export');

    // Reload danh sách (không lọc)
    Route::get('/order/reload', [OrderController::class, 'reload'])->name('order.reload');
    Route::view('/payments_gateway', 'admin.payments_gateway')->name('payments_gateway');
    Route::view('/report', 'admin.report')->name('report');
    Route::view('/return', 'admin.return')->name('return');
    Route::view('/warranties', 'admin.warranties')->name('warranties');
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
    Route::view('/product', 'customer.product');
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



