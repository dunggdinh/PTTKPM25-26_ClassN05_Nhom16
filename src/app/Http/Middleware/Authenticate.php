<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
<<<<<<< HEAD
use Illuminate\Http\Request;
=======
>>>>>>> 08f49c4fe2cbf8a2278695ac29cc7b4c4a4d7aed

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
<<<<<<< HEAD
    protected function redirectTo(Request $request): ?string
    {
        // Sửa từ route('login') thành route('auth.login')
        return $request->expectsJson() ? null : route('auth.login');
    }
}
=======
    protected function redirectTo($request): ?string
    {
        if (! $request->expectsJson()) {
            return route('login'); // hoặc 'auth.login' nếu route của mày đặt là vậy
        }

        return null;
    }
}
>>>>>>> 08f49c4fe2cbf8a2278695ac29cc7b4c4a4d7aed
