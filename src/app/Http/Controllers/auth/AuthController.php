<?php
namespace App\Http\Controllers\auth;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Auth;
// use App\Models\User;
// use Illuminate\Support\Str;
// class AuthController extends Controller
// {
//     // ======= VIEWS =======
//     public function showRegisterForm() { return view('auth.register'); }
//     public function showLoginForm()    { return view('auth.login'); }
//     public function showResetForm()    { return view('auth.reset_password'); }

//     // ======= RESET PASSWORD (demo điều hướng) =======
//     public function handleReset(Request $request)
//     {
//         $request->validate(['email'=>['required','email']]);
//         // TODO: tích hợp Password Broker để gửi email reset
//         return back()->with('status','Nếu email tồn tại, hệ thống sẽ gửi liên kết đặt lại mật khẩu.');
//     }

//     // ======= REGISTER =======
//     public function register(Request $request)
//     {
//     // 1) KHÔNG yêu cầu role nữa
//         $data = $request->validate([
//             'firstName'   => ['required','string','max:100'],
//             'lastName'    => ['required','string','max:100'],
//             'email'       => ['required','email:rfc,dns','max:255','unique:users,email'],
//             'password'    => ['required','confirmed','min:6'],

//             // role bỏ đi để tự suy ra theo domain
//             'birth_date'  => ['required','date'],
//             'gender'      => ['required','in:Nam,Nữ,Khác'], // male/female/other hoặc Nam/Nữ/Khác
//             'phone'       => ['required','string','max:20'],
//             'address'     => ['required','string','max:255'],
//         ]);

//         $fullName = trim($data['firstName'].' '.$data['lastName']);

//         // 2) Map giới tính VN -> EN (giữ như bạn)
//         $g = mb_strtolower(trim($data['gender']));
//         $genderMap = ['nam'=>'male','nữ'=>'female','nu'=>'female','khác'=>'other','khac'=>'other'];
//         $gender = $genderMap[$g] ?? $g;

//         // 3) TỰ GÁN role & prefix THEO DOMAIN EMAIL
//         $domain = Str::lower(Str::after($data['email'], '@')); // phần sau dấu @
//         if ($domain === 'ad.com') {
//             $role   = 'admin';
//             $prefix = 'AD';
//         } else {
//             $role   = 'customer';
//             $prefix = 'KH';
//         }

//         // 4) Sinh user_id + lưu
//         return DB::transaction(function () use ($data, $fullName, $gender, $role, $prefix) {
//             $last = DB::table('users')
//                 ->whereRaw("user_id LIKE ? ESCAPE '\\\\'", [$prefix.'\_%'])
//                 ->selectRaw("MAX(CAST(SUBSTRING(user_id, 4) AS UNSIGNED)) AS max_num")
//                 ->lockForUpdate()
//                 ->value('max_num');

//             $next = (int)($last ?? 0) + 1;
//             $uid  = sprintf('%s_%03d', $prefix, $next); // AD_001 / KH_001

//             User::create([
//                 'user_id'    => $uid,
//                 'name'       => $fullName,
//                 'email'      => $data['email'],
//                 'password'   => Hash::make($data['password']),
//                 'role'       => $role,            // <-- MỚI: auto theo domain
//                 'birth_date' => $data['birth_date'],
//                 'gender'     => $gender,
//                 'phone'      => $data['phone'],
//                 'address'    => $data['address'],
//             ]);

//             return redirect()->route('auth.login')
//                 ->with('status','Đăng ký thành công! Hãy đăng nhập.');
//         });
//     }
//     // ======= LOGIN =======
//     public function login(Request $request)
//     {
//         // Validate email & password
//         $credentials = $request->validate([
//             'email'    => ['required','email'],
//             'password' => ['required'],
//         ]);
//         // Hỗ trợ "ghi nhớ đăng nhập" nếu form có <input type="checkbox" name="remember">
//         $remember = $request->boolean('remember');
//         if (Auth::attempt($credentials, $remember)) {
//             // Bảo vệ session fixation
//             $request->session()->regenerate();

//             // Tuỳ ý điều hướng theo role
//             $user = Auth::user();
//             if ($user && $user->role === 'admin') {
//                 // đổi route theo dự án của bạn
//                 return redirect()->intended('/admin/dashboard')->with('success','Đăng nhập thành công!');
//             }
//             // Khách hàng
//             return redirect()->intended('/')->with('success','Đăng nhập thành công!');
//         }

//         // Sai thông tin: quay lại form, giữ lại email cũ
//         return back()
//             ->withErrors(['email' => 'Email hoặc mật khẩu không đúng.'])
//             ->onlyInput('email');
//     }

//     // ======= LOGOUT =======
//     public function logout(Request $request)
//     {
//         Auth::logout();
//         // Vô hiệu session hiện tại và CSRF token
//         $request->session()->invalidate();
//         $request->session()->regenerateToken();

//         return redirect()->route('auth.login')->with('status','Đã đăng xuất.');
//     }
// }
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /* ===== VIEWS ===== */
    public function showRegisterForm() { return view('auth.register'); }
    public function showLoginForm()    { return view('auth.login'); }
    public function showResetForm()    { return view('auth.reset_password'); }

    /* ===== RESET PASSWORD (demo) ===== */
    public function handleReset(Request $request)
    {
        $request->validate(['email' => ['required','email']]);
        return back()->with('status','Nếu email tồn tại, hệ thống sẽ gửi liên kết đặt lại mật khẩu.');
    }

    /* ===== HELPER: Sinh ID AD_/KH_ với 3 chữ số ===== */
    private function generateUid3(string $prefix): string
    {
        return DB::transaction(function () use ($prefix) {
            $maxNum = DB::table('users')
                ->whereRaw("user_id LIKE ? ESCAPE '\\\\'", [$prefix.'\_%'])
                ->selectRaw("MAX(CAST(SUBSTRING(user_id, 4) AS UNSIGNED)) AS max_num")
                ->lockForUpdate()
                ->value('max_num');

            $next = (int)($maxNum ?? 0) + 1;
            return sprintf('%s_%03d', $prefix, $next); // AD_001 / KH_001
        });
    }

    /* ===== REGISTER ===== */
    public function register(Request $request)
    {
        $data = $request->validate([
            'firstName'   => ['required','string','max:100'],
            'lastName'    => ['required','string','max:100'],
            'email'       => ['required','email:rfc,dns','max:255','unique:users,email'],
            'password'    => ['required','confirmed','min:6'],
            'birth_date'  => ['required','date'],
            'gender'      => ['required','in:Nam,Nữ,Khác'], // khớp enum VN trong DB
            'phone'       => ['required','string','max:20'],
            'address'     => ['required','string','max:255'],
        ]);

        // Quy ước: email @ad.com => admin (AD_), còn lại => customer (KH_)
        $email   = Str::lower($data['email']);
        $isAdmin = Str::endsWith($email, '@ad.com');
        $role    = $isAdmin ? 'admin' : 'customer';
        $prefix  = $isAdmin ? 'AD'    : 'KH';

        $uid = $this->generateUid3($prefix);

        User::create([
            'user_id'    => $uid,
            'name'       => trim($data['firstName'].' '.$data['lastName']),
            'email'      => $data['email'],
            'password'   => Hash::make($data['password']),
            'role'       => $role,
            'birth_date' => $data['birth_date'],
            'gender'     => $data['gender'],   // 'Nam' / 'Nữ' / 'Khác'
            'phone'      => $data['phone'],
            'address'    => $data['address'],
        ]);

        return redirect()->route('auth.login')->with('status','Đăng ký thành công! Hãy đăng nhập.');
    }

    /* ===== LOGIN ===== */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required','email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user && $user->role === 'admin') {
                //admin
                // return redirect()->intended('/admin/dashboard')->with('success','Đăng nhập thành công!');
                return redirect()->route('admin.dashboard')->with('success','Đăng nhập thành công!');
            }
            // return redirect()->intended('/')->with('success','Đăng nhập thành công!');
            //Khach hang
            return redirect()->route('customer.home')->with('success','Đăng nhập thành công!');
        }

        return back()->withErrors(['email' => 'Email hoặc mật khẩu không đúng.'])->onlyInput('email');
    }

    /* ===== LOGOUT ===== */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.login')->with('status','Đã đăng xuất.');
    }
}
