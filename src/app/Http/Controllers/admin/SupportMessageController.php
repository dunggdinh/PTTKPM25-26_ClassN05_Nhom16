<?php

// namespace App\Http\Controllers\admin;

// use App\Http\Controllers\Controller;
// use App\Http\Requests\SendSupportMessageRequest;
// use App\Models\admin\SupportMessage;
// use App\Models\admin\SupportParticipant;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;

// class SupportMessageController extends Controller
// {
//     // GET /conversations/{id}/messages
//     public function index(int $id)
//     {
//         $messages = SupportMessage::with('sender')
//             ->where('conversation_id', $id)
//             ->orderBy('sent_at')
//             ->get();

//         return response()->json($messages);
//     }

//     // POST /conversations/{id}/messages
//     public function store(SendSupportMessageRequest $req, int $id)
//     {
//         $user = $req->user(); // có user_id & role ('admin'|'customer')
//         $data = $req->validated();
//         // ✅ Nhận biết vai trò theo route prefix
//         $isAdmin = $req->is('admin/*');
//         $role = $isAdmin ? 'admin' : ($user->role ?? 'customer');

//         $message = DB::transaction(function () use ($id, $user, $data) {
//             // 1) tạo message
//             $msg = SupportMessage::create([
//                 'conversation_id' => $id,
//                 'sender_id'       => $user->user_id,
//                 'sender_role'     => $user->role ?? 'admin',
//                 'sender_role'     => $role, // ✅ Gán đúng vai trò thự
//                 'content'         => $data['content'],
//                 'sent_at'         => now(),
//             ]);

//             // 2) upsert participant theo người gửi (KHÔNG hardcode admin)
//             SupportParticipant::updateOrCreate(
//                 ['conversation_id' => $id, 'user_id' => $user->user_id],
//                 ['role' => $user->role ?? 'admin', 'last_read_at' => now()]
//             );

//             //3) (tuỳ chọn) broadcast realtime
//             // event(new \App\Event\SupportMessageCreated($id, [
//             //     'message_id'      => $msg->message_id ?? null,
//             //     'conversation_id' => $msg->conversation_id,
//             //     'sender_id'       => $msg->sender_id,
//             //     'sender_role'     => $msg->sender_role,
//             //     'content'         => $msg->content,
//             //     'sent_at'         => $msg->sent_at,
//             // ]));

//             return $msg->fresh();
//         });

//         return response()->json($message, 201);
//     }
// }

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SendSupportMessageRequest;
use App\Models\admin\SupportMessage;
use App\Models\admin\SupportParticipant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupportMessageController extends Controller
{
    // GET /conversations/{id}/messages
    public function index(int $id)
    {
        $messages = SupportMessage::with('sender')
            ->where('conversation_id', $id)
            ->orderBy('sent_at')
            ->get();

        return response()->json($messages);
    }

    // POST /conversations/{id}/messages
    public function store(SendSupportMessageRequest $req, int $id)
    {
        // ✅ Lấy thông tin người dùng hiện tại
        $user = $req->user();
        $data = $req->validated();

        // ✅ Xác định rõ vai trò theo route prefix hoặc guard
        // $role = $req->is('admin/*')
        //     ? 'admin'
        //     : ($user->role ?? 'customer');
        $role = $user->role ?? 'customer';
        if ($req->routeIs('admin.*') || str_starts_with($req->path(), 'admin/')) {
            $role = 'admin';
        }

        $message = DB::transaction(function () use ($id, $user, $data, $role) {
            // 1️⃣ Tạo tin nhắn mới
            $msg = SupportMessage::create([
                'conversation_id' => $id,
                'sender_id'       => $user->user_id,
                'sender_role'     => $role,
                'content'         => $data['content'],
                'sent_at'         => now(),
            ]);

            // 2️⃣ Cập nhật participant
            SupportParticipant::updateOrCreate(
                ['conversation_id' => $id, 'user_id' => $user->user_id],
                ['role' => $role, 'last_read_at' => now()]
            );

            // 3️⃣ (Tùy chọn) Gửi event realtime
            // event(new \App\Events\SupportMessageCreated($msg));

            return $msg->fresh();
        });

        return response()->json($message, 201);
    }
}

