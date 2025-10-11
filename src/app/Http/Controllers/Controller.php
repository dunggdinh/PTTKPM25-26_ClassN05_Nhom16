<?php

// namespace App\Http\Controllers;

// abstract class Controller
// {
//     //
// }
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // Hiển thị form đăng ký
    public function showRegisterForm() {
        return view('auth.register');
    }

    // Xử lý form đăng ký
    public function register(Request $request) {
        // Gộp họ và tên từ form
        $fullName = trim($request->firstName . ' ' . $request->lastName);

        // Kiểm tra dữ liệu nhập
        $request->validate([
            'firstName' => 'required|max:50',
            'lastName' => 'required|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Lưu vào database
        DB::table('users')->insert([
            'user_id' => Str::uuid(),
            'name' => $fullName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Chuyển hướng về trang đăng nhập
        return redirect('/auth/login')->with('success', 'Đăng ký thành công!');
    }
}
