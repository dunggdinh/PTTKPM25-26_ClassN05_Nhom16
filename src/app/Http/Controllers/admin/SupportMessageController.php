<?php
// namespace App\Http\Controllers\admin;

// use App\Http\Controllers\Controller;
// use App\Http\Requests\SendSupportMessageRequest;
// use App\Models\admin\SupportMessage;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;

// class SupportMessageController extends Controller
// {
//     // ✅ Lấy toàn bộ tin nhắn (không cần conversation)
//     public function index()
//     {
//         $messages = SupportMessage::orderBy('sent_at')->get();
//         return response()->json($messages);
//     }

//     // ✅ Gửi tin nhắn mới
//     // public function store(SendSupportMessageRequest $req)
//     public function store(Request $req)
//     {
//         $user = $req->user();
//         $data = $req->validated();

//         // ✅ Nhận dạng vai trò
//         $role = $user->role ?? 'customer';
//         if ($req->routeIs('admin.*') || str_starts_with($req->path(), 'admin/')) {
//             $role = 'admin';
//         }

//         $message = DB::transaction(function () use ($user, $data, $role) {
//             $msg = SupportMessage::create([
//                 'sender_id'   => $user->user_id,
//                 'sender_role' => $role,
//                 'content'     => $data['content'],
//                 'sent_at'     => now(),
//             ]);
//             return $msg->fresh();
//         });

//         return response()->json($message, 201);
//     }
// }
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\SupportMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupportMessageController extends Controller
{
    // ✅ Lấy toàn bộ tin nhắn (không cần conversation)
    public function index()
    {
        $messages = SupportMessage::orderBy('sent_at')->get();
        return response()->json($messages);
    }

    // ✅ Gửi tin nhắn mới
    public function store(Request $req)
    {
        $user = $req->user();

        // ✅ Nhận dạng vai trò
        $role = $user->role ?? 'customer';
        if ($req->routeIs('admin.*') || str_starts_with($req->path(), 'admin/')) {
            $role = 'admin';
        }

        $message = DB::transaction(function () use ($user, $req, $role) {
            $msg = SupportMessage::create([
                'sender_id'   => $user->user_id,
                'sender_role' => $role,
                'content'     => $req->input('content'), // 🔹 dùng input() thay vì validated()
                'sent_at'     => now(),
            ]);
            return $msg->fresh();
        });

        return response()->json($message, 201);
    }
}

