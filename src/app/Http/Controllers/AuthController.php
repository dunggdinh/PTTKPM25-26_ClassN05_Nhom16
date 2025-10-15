<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'firstName' => 'required|max:50',
            'lastName'  => 'required|max:50',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:6|confirmed',
        ]);

        $fullName = trim($data['firstName'].' '.$data['lastName']);

        // Tạo user_id dạng UUID (hoặc bạn có thể dùng pattern riêng của bạn)
        $uid = (string) Str::uuid();       // ví dụ: "25b0e0d8-..."
        // $uid = 'UID_'.Str::upper(Str::random(6)); // nếu muốn giống UID_ABC123

        User::create([
            'user_id'  => $uid,
            'name'     => $fullName,
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('auth.login')->with('success', 'Đăng ký thành công!');
    }
}
