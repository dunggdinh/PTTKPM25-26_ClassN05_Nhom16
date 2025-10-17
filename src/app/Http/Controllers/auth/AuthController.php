<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\User;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Str;
// use Illuminate\Support\Facades\DB;

// class AuthController extends Controller
// {
//     public function showRegisterForm()
//     {
//         return view('auth.register');
//     }

//     public function register(Request $request)
//     {
//         $data = $request->validate([
//             'firstName'   => 'required|max:50',
//             'lastName'    => 'required|max:50',
//             'email'       => 'required|email|unique:users,email',
//             'password'    => 'required|min:6|confirmed',
//             'birth_date'  => 'nullable|date',
//             'gender'      => 'nullable|in:Nam,Nữ,Khác',
//             'phone'       => 'nullable|max:20',
//             'address'     => 'nullable|max:255',
//             'role'        => 'nullable|in:customer,admin', // thêm nếu form có chọn loại tài khoản
//         ]);

//         $fullName = trim($data['firstName'] . ' ' . $data['lastName']);
//         $role = $data['role'] ?? 'customer'; // mặc định khách hàng

//         // 🔹 Tiền tố
//         $prefix = $role === 'admin' ? 'AD' : 'KH';

//         // 🔹 Lấy số lớn nhất trong user_id hiện có với prefix đó
//         $lastId = DB::table('users')
//             ->where('user_id', 'LIKE', "{$prefix}_%")
//             ->selectRaw("MAX(CAST(SUBSTRING(user_id, LOCATE('_', user_id) + 1) AS UNSIGNED)) AS max_num")
//             ->value('max_num');

//         $nextNumber = ($lastId ?? 0) + 1;

//         // 🔹 Sinh ID theo định dạng
//         $uid = $role === 'admin'
//             ? sprintf('AD_%04d', $nextNumber)
//             : sprintf('KH_%03d', $nextNumber);

//         // 🔹 Tạo user mới
//         User::create([
//             'user_id'   => $uid,
//             'name'      => $fullName,
//             'email'     => $data['email'],
//             'password'  => Hash::make($data['password']),
//             'role'      => $role,
//             'birth_date'=> $data['birth_date'] ?? null,
//             'gender'    => $data['gender'] ?? null,
//             'phone'     => $data['phone'] ?? null,
//             'address'   => $data['address'] ?? null,
//         ]);

//         return redirect()->route('auth.login')->with('success', 'Đăng ký thành công!');
//     }
// }
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showRegisterForm() { return view('auth.register'); }
    public function showLoginForm()    { return view('auth.login'); }

    // Đăng ký: lưu vào DB, sinh KH_00x, redirect -> login
    public function register(Request $request)
    {
        $data = $request->validate([
            'firstName' => 'required|max:50',
            'lastName'  => 'required|max:50',
            'email'     => 'required|email:rfc,dns|unique:users,email',
            'password'  => 'required|min:6|confirmed',
        ]);

        $fullName = trim($data['firstName'].' '.$data['lastName']);
        $prefix   = 'KH';   // sau này có admin thì prefix 'AD'
        $role     = 'customer';

        return DB::transaction(function () use ($fullName, $data, $prefix, $role) {
            // Lấy số lớn nhất hiện có theo prefix an toàn cho concurrent
            $last = DB::table('users')
                ->where('user_id','LIKE', $prefix.'\_%')
                ->selectRaw("MAX(CAST(SUBSTRING(user_id, LOCATE('_', user_id)+1) AS UNSIGNED)) AS max_num")
                ->lockForUpdate() // tránh đụng độ khi 2 người đăng ký cùng lúc
                ->value('max_num');

            $next  = (int)($last ?? 0) + 1;
            $uid   = sprintf('%s_%03d', $prefix, $next); // KH_001, KH_002,...

            User::create([
                'user_id'  => $uid,
                'name'     => $fullName,
                'email'    => $data['email'],
                'password' => Hash::make($data['password']),
                'role'     => $role,
            ]);

            return redirect()
                ->route('auth.login')
                ->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
        });
    }

    // Đăng nhập: kiểm tra & chuyển hướng
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email:rfc,dns',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            // Có thể tách theo role:
            // return Auth::user()->role === 'admin'
            //     ? redirect()->route('admin.dashboard')
            //     : redirect()->route('customer.home');
            return redirect()->route('customer.home')->with('success', 'Đăng nhập thành công!');
        }

        return back()->withErrors(['email' => 'Sai email hoặc mật khẩu.'])->onlyInput('email');
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('auth.login')->with('success', 'Đã đăng xuất.');
    }
}
