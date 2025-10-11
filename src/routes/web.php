<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\AuthController;



Route::get('/customer', function () {
    return view('customer.home');   // resources/views/customer/home.blade.php
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/customers', function () {
        return view('admin.customer');
    })->name('customers');

    Route::get('/chat', function () {
        return view('admin.chat');
    })->name('chat');

    Route::get('/deliveries', function () {
        return view('admin.deliveries');
    })->name('deliveries');

    Route::get('/home', function () {
        return view('admin.home');
    })->name('home');

    Route::get('/inventory', function () {
        return view('admin.inventory');
    })->name('inventory');

    Route::get('/payments-gateway', function () {
        return view('admin.payments_gateway');
    })->name('payments_gateway');

    Route::get('/products', function () {
        return view('admin.products');
    })->name('products');

    Route::get('/returns', function () {
        return view('admin.returns');
    })->name('returns');

    Route::get('/staff', function () {
        return view('admin.staff');
    })->name('staff');

    Route::get('/stock-alerts', function () {
        return view('admin.stock-alerts');
    })->name('stock-alerts');

    Route::get('/warranties', function () {
        return view('admin.warranties');
    })->name('warranties');
});


Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');
    // tạm thời để vậy
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('register');

    Route::get('/reset_password', function () {
        return view('auth.reset_password');
    })->name('reset_password');
});


Route::prefix('customer')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('customer.dashboard');

    Route::get('/cart', function () {
        return view('cart');
    })->name('customer.cart');

    Route::get('/home', function () {
        return view('home');
    })->name('customer.home');

    Route::get('/orders', function () {
        return view('order');
    })->name('customer.orders');

    Route::get('/profile', function () {
        return view('profile');
    })->name('customer.profile');

    Route::get('/promotion', function () {
        return view('promotion');
    })->name('customer.promotion');

    Route::get('/review', function () {
        return view('review');
    })->name('customer.review');

    Route::get('/store', function () {
        return view('store');
    })->name('customer.store');

    Route::get('/support', function () {
        return view('support');
    })->name('customer.support');
});


Route::get('/b', function () {
    return view('customer.t');      // resources/views/admin/home.blade.php
});
Route::get('/c', function () {
    return view('customer1.a');      // resources/views/admin/home.blade.php
});
Route::get('/d', function () {
    return view('customer1.b');      // resources/views/admin/home.blade.php
});
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
// Route::get('/js/products.css', function () {
//     $path = resource_path('css/products.css');
//     return Response::make(File::get($path), 200, [
//         'Content-Type' => 'text/css'
//     ]);
// });
// Route::get('/payments', function () {
//     return view('payments_gateway');
// });
