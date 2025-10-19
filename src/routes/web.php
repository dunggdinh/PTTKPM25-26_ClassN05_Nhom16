<?php
//                      ĐÂY LÀ CODE MỚI
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\Admin\CustomerController;

use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\Admin\DeliveryController;
use App\Http\Controllers\InventoryController;

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
    Route::view('/inventory', 'admin.inventory')->name('inventory');
    Route::view('/order', 'admin.order')->name('order');
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

// Route test (có thể xóa nếu không cần)
Route::get('/b', function () {
    return view('admin.a');
});
Route::get('/c', function () {
    return view('customer1.a');
});
Route::get('/d', function () {
    return view('customer1.b');
});

// Serve static files
Route::get('/css/app.css', function () {
    $path = resource_path('css/app.css');
    return Response::make(File::get($path), 200, [
        'Content-Type' => 'text/css'
    ]);
});
Route::get('/css/payments_gateway.css', function () {
    $path = resource_path('css/payments_gateway.css');
    return Response::make(File::get($path), 200, [
        'Content-Type' => 'text/css'
    ]);
});
Route::get('/js/products.js', function () {
    $path = resource_path('js/products.js');
    return Response::make(File::get($path), 200, [
        'Content-Type' => 'text/javascript'
    ]);
});

// Payment routes
Route::get('/checkout', function () {
    return view('checkout');
});
Route::post('/vnpay-payment', [PaymentController::class, 'createPayment']);
Route::get('/vnpay-return', [PaymentController::class, 'returnPayment']);


// Shipment 
Route::get('/deliveries', [ShipmentController::class, 'index'])->name('deliveries.index');
Route::post('/shipments', [ShipmentController::class, 'store'])->name('shipments.store');
Route::get('/shipments/{id}', [ShipmentController::class, 'show'])->name('shipments.show');
Route::put('/shipments/{id}', [ShipmentController::class, 'update'])->name('shipments.update');
Route::delete('/shipments/{id}', [ShipmentController::class, 'destroy'])->name('shipments.destroy');
Route::post('/shipments/export', [ShipmentController::class, 'export'])->name('shipments.export');


// Deli
// Route::prefix('admin')->group(function () {
Route::prefix('admin')->middleware(['auth','ensure.admin'])->group(function () {
    Route::get('/deliveries', [DeliveryController::class, 'index'])->name('admin.deliveries.index');
    Route::get('/deliveries/create', [DeliveryController::class, 'create'])->name('admin.deliveries.create');
    Route::post('/deliveries', [DeliveryController::class, 'store'])->name('admin.deliveries.store');
    Route::get('/deliveries/{id}/edit', [DeliveryController::class, 'edit'])->name('admin.deliveries.edit');
    Route::put('/deliveries/{id}', [DeliveryController::class, 'update'])->name('admin.deliveries.update');
    Route::delete('/deliveries/{id}', [DeliveryController::class, 'destroy'])->name('admin.deliveries.destroy');
    Route::post('/deliveries/export', [DeliveryController::class, 'export'])->name('admin.deliveries.export');
});


// Inventory
Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
Route::get('/api/inventory/products', [InventoryController::class, 'getProducts']);
Route::get('/api/inventory/alerts', [InventoryController::class, 'getAlerts']);
Route::get('/api/inventory/product/{id}', [InventoryController::class, 'getProductDetails']);
Route::put('/api/inventory/product/{id}', [InventoryController::class, 'updateStock']);
Route::delete('/api/inventory/product/{id}', [InventoryController::class, 'delete']);
Route::post('/api/inventory/export', [InventoryController::class, 'export']);