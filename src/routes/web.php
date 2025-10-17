<?php
//                          ĐÂY LÀ CODE CŨ
// use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\File;
// use Illuminate\Support\Facades\Response;
// use App\Http\Controllers\AuthController;
// use App\Http\Controllers\PaymentController;


// Route::get('/customer', function () {
//     return view('customer.home');   // resources/views/customer/home.blade.php
// });

// //Route Laravel cần
// Route::prefix('admin')->name('admin.')->group(function () {
//     Route::view('/home', 'admin.home')->name('home');
//     Route::view('/dashboard', 'admin.dashboard')->name('dashboard');
//     Route::view('/chat', 'admin.chat')->name('chat');
//     Route::view('/customers', 'admin.customers')->name('customers');
//     Route::view('/inventory', 'admin.inventory')->name('inventory');
//     Route::view('/payments_gateway', 'admin.payments_gateway')->name('payments_gateway');
//     Route::view('/returns', 'admin.returns')->name('returns');
//     Route::view('/report', 'admin.report')->name('report');
//     Route::view('/warranties', 'admin.warranties')->name('warranties');
// });


// Route::prefix('admin')->name('admin.')->group(function () {
//     Route::get('/dashboard', function () {
//         return view('admin.dashboard');
//     })->name('dashboard');

//     Route::get('/customers', function () {
//         return view('admin.customer');
//     })->name('customers');

//     Route::get('/chat', function () {
//         return view('admin.chat');
//     })->name('chat');

//     Route::get('/deliveries', function () {
//         return view('admin.deliveries');
//     })->name('deliveries');

//     Route::get('/home', function () {
//         return view('admin.home');
//     })->name('home');

//     Route::get('/inventory', function () {
//         return view('admin.inventory');
//     })->name('inventory');

//     Route::get('/payments-gateway', function () {
//         return view('admin.payments_gateway');
//     })->name('payments_gateway');

//     Route::get('/products', function () {
//         return view('admin.products');
//     })->name('products');

//     Route::get('/returns', function () {
//         return view('admin.returns');
//     })->name('returns');

//     Route::get('/staff', function () {
//         return view('admin.staff');
//     })->name('staff');

//     Route::get('/stock-alerts', function () {
//         return view('admin.stock-alerts');
//     })->name('stock-alerts');

//     Route::get('/warranties', function () {
//         return view('admin.warranties');
//     })->name('warranties');
// });


// Route::prefix('auth')->name('auth.')->group(function () {
//     Route::get('/login', function () {
//         return view('auth.login');
//     })->name('login');
//     // đừng xóa vội
//     // Route::get('/register', function () {
//     //     return view('auth.register');
//     // })->name('register');
//     // tạm thời để vậy
//     Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
//     Route::post('/register', [AuthController::class, 'register'])->name('register');

//     Route::get('/reset_password', function () {
//         return view('auth.reset_password');
//     })->name('reset_password');
// });


// Route::prefix('customer')->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('customer.dashboard');

//     Route::get('/cart', function () {
//         return view('cart');
//     })->name('customer.cart');

//     Route::get('/home', function () {
//         return view('home');
//     })->name('customer.home');

//     Route::get('/orders', function () {
//         return view('order');
//     })->name('customer.orders');

//     Route::get('/profile', function () {
//         return view('profile');
//     })->name('customer.profile');

//     Route::get('/promotion', function () {
//         return view('promotion');
//     })->name('customer.promotion');

//     Route::get('/review', function () {
//         return view('review');
//     })->name('customer.review');

//     Route::get('/store', function () {
//         return view('store');
//     })->name('customer.store');

//     Route::get('/support', function () {
//         return view('support');
//     })->name('customer.support');
// });


// Route::get('/b', function () {
//     return view('customer.t');      // resources/views/admin/home.blade.php
// });
// Route::get('/c', function () {
//     return view('customer1.a');      // resources/views/admin/home.blade.php
// });
// Route::get('/d', function () {
//     return view('customer1.b');      // resources/views/admin/home.blade.php
// });
// Route::get('/css/app.css', function () {
//     $path = resource_path('css/app.css');
//     return Response::make(File::get($path), 200, [
//         'Content-Type' => 'text/css'
//     ]);
// });
// Route::get('/css/payments_gateway.css', function () {
//     $path = resource_path('css/payments_gateway.css');
//     return Response::make(File::get($path), 200, [
//         'Content-Type' => 'text/css'
//     ]);
// });
// Route::get('/js/products.js', function () {
//     $path = resource_path('js/products.js');
//     return Response::make(File::get($path), 200, [
//         'Content-Type' => 'text/javascript'
//     ]);
// });
// // Route::get('/js/products.css', function () {
// //     $path = resource_path('css/products.css');
// //     return Response::make(File::get($path), 200, [
// //         'Content-Type' => 'text/css'
// //     ]);
// // });
// // Route::get('/payments', function () {
// //     return view('payments_gateway');
// // });
// // Route để hiển thị trang thanh toán
// Route::get('/checkout', function () {
//     return view('checkout');
// });

// // Route để xử lý việc tạo thanh toán
// Route::post('/vnpay-payment', [PaymentController::class, 'createPayment']);

// // Route để VNPAY trả kết quả về
// Route::get('/vnpay-return', [PaymentController::class, 'returnPayment']);



//                      ĐÂY LÀ CODE MỚI
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;


// Nhóm route admin (gộp lại)
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/layout', function () {
        return view('admin.layout');
    })->name('layout');

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/chat', function () {
        return view('admin.chat');
    })->name('chat');

    Route::get('/customer', function () {
        return view('admin.customer');
    })->name('customer');

    Route::get('/deliveries', function () {
        return view('admin.deliveries');
    })->name('deliveries');

    Route::get('/inventory', function () {
        return view('admin.inventory');
    })->name('inventory');

    Route::get('/order', function () {
        return view('admin.order');
    })->name('order');

    Route::get('/payments_gateway', function () {
        return view('admin.payments_gateway');
    })->name('payments_gateway');

    Route::get('/report', function () {
        return view('admin.report');
    })->name('report');

    Route::get('/return', function () {
        return view('admin.return');
    })->name('return');

    Route::get('/warranties', function () {
        return view('admin.warranties');
    })->name('warranties');
});


// Nhóm route auth
Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('register');

    Route::get('/reset_password', function () {
        return view('auth.reset_password');
    })->name('reset_password');
});

// Nhóm route customer
Route::prefix('customer')->name('customer.')->group(function () {

    Route::get('/home', function () {
        return view('customer.home');
    })->name('home');

    Route::get('/cart', function () {
        return view('customer.cart');
    })->name('cart');

    Route::get('/layout', function () {
        return view('customer.layout');
    })->name('layout');

    Route::get('/order', function () {
        return view('customer.order');
    })->name('order');

    Route::get('/profile', function () {
        return view('customer.profile');
    })->name('profile');

    Route::get('/promotion', function () {
        return view('customer.promotion');
    })->name('promotion');

    Route::get('/review', function () {
        return view('customer.review');
    })->name('review');

    Route::get('/store', function () {
        return view('customer.store');
    })->name('store');

    Route::get('/support', function () {
        return view('customer.support');
    })->name('support');
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