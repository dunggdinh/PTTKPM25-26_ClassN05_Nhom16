<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// Nếu bạn đang dùng model Customer ánh xạ bảng users như trước:
use App\Models\admin\Customer; // hoặc App\Models\User nếu bạn dùng User mặc định

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('customer.profile', compact('user'));
    }

    public function __construct()
    {
        // bắt buộc đăng nhập mới vào được profile
        $this->middleware('auth');
        // nếu bạn có phân quyền theo cột role, có thể kiểm tra ở middleware hoặc ở mỗi action
    }

    // Hiển thị hồ sơ của CHÍNH mình
    public function show()
    {
        $user = auth::user();
        return view('customer.profile', compact('user'));
    }


    // Cập nhật thông tin cơ bản
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|max:255|unique:users,email,' . $user->user_id . ',user_id',
            'phone'      => 'nullable|string|max:20',
            'address'    => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'gender'     => 'nullable|in:male,female,other',
        ]);

        // Nếu bạn dùng model Customer ánh xạ bảng users:
        // $user ở đây là instance User (mặc định). Nếu bạn muốn dùng Customer model, có thể:
        // $customer = Customer::findOrFail($user->user_id);
        // $customer->fill($validated)->save();
        // Cách đơn giản: cập nhật trực tiếp trên $user nếu $user là Eloquent cho bảng users:
        $user->fill($validated);
        $user->save();

        return back()->with('success', 'Cập nhật hồ sơ thành công!');
    }

    // Đổi mật khẩu
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password'      => 'required',
            'password'              => 'required|min:8|confirmed',
        ], [
            'password.confirmed' => 'Xác nhận mật khẩu mới không khớp.',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Đổi mật khẩu thành công!');
    }
<<<<<<< HEAD
} 
// Lỗi


// namespace App\Http\Controllers\customer;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;

// class ProfileController extends Controller
// {
//     public function __construct()
//     {
//         // Bắt buộc đăng nhập mới vào được profile
//         $this->middleware('auth');
//     }

//     // Hiển thị hồ sơ của CHÍNH mình
//     public function show()
//     {
//         $user = Auth::user();
        
//         // Kiểm tra thêm để đảm bảo user tồn tại
//         if (!$user) {
//             return redirect()->route('auth.login')
//                 ->withErrors(['error' => 'Vui lòng đăng nhập để xem hồ sơ.']);
//         }
        
//         return view('customer.profile', compact('user'));
//     }

//     // Cập nhật thông tin cơ bản
//     public function update(Request $request)
//     {
//         $user = Auth::user();

//         $validated = $request->validate([
//             'name'       => 'required|string|max:255',
//             'email'      => 'required|email|max:255|unique:users,email,' . $user->user_id . ',user_id',
//             'phone'      => 'nullable|string|max:20',
//             'address'    => 'nullable|string|max:255',
//             'birth_date' => 'nullable|date',
//             'gender'     => 'nullable|in:male,female,other',
//         ]);

//         $user->fill($validated);
//         $user->save();

//         return back()->with('success', 'Cập nhật hồ sơ thành công!');
//     }

//     // Đổi mật khẩu
//     public function updatePassword(Request $request)
//     {
//         $request->validate([
//             'current_password' => 'required',
//             'password'         => 'required|min:8|confirmed',
//         ], [
//             'password.confirmed' => 'Xác nhận mật khẩu mới không khớp.',
//         ]);

//         $user = Auth::user();

//         if (!Hash::check($request->current_password, $user->password)) {
//             return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng.']);
//         }

//         $user->password = Hash::make($request->password);
//         $user->save();

//         return back()->with('success', 'Đổi mật khẩu thành công!');
//     }
// }
=======
    public function getUsername()
    {
        $user = Auth::user();

        // Nếu cột lưu tên là 'name' thì:
        return response()->json([
            'username' => $user->name,
        ]);

        // Hoặc nếu cột là 'username' thì:
        // return response()->json(['username' => $user->username]);
    }

}


>>>>>>> 08f49c4fe2cbf8a2278695ac29cc7b4c4a4d7aed
