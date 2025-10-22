<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // Nếu bạn có guard 'admin', dùng guard đó; nếu không thì fallback Auth mặc định
    protected function currentAdmin()
    {
        return Auth::guard('admin')->user() ?? Auth::user();
    }

    // GET /admin/notifications
    public function list(Request $request)
    {
        $admin = $this->currentAdmin();
        if (!$admin) return response()->json(['unread' => 0, 'items' => []]);

        $unread = $admin->unreadNotifications()->count();

        $items = $admin->notifications()->latest()->take(30)->get()->map(function($n){
            return [
                'id'      => $n->id,
                'title'   => $n->data['title']   ?? 'Thông báo',
                'message' => $n->data['message'] ?? '',
                'icon'    => $n->data['icon']    ?? null,   // blue/green/red
                'url'     => $n->data['url']     ?? null,
                'time'    => $n->created_at?->diffForHumans(),
                'read_at' => $n->read_at,
                'tag'     => $n->data['tag']     ?? null,
            ];
        })->values();

        return response()->json(['unread' => $unread, 'items' => $items]);
    }

    // POST /admin/notifications/read-all
    public function markAllRead()
    {
        if ($a = $this->currentAdmin()) $a->unreadNotifications->markAsRead();
        return response()->json(['ok' => true]);
    }

    // POST /admin/notifications/{id}/read
    public function markOneRead(string $id)
    {
        if ($a = $this->currentAdmin()) {
            $n = $a->notifications()->where('id',$id)->first();
            if ($n && !$n->read_at) $n->markAsRead();
        }
        return response()->json(['ok' => true]);
    }

    // DELETE /admin/notifications/{id}
    public function remove(string $id)
    {
        if ($a = $this->currentAdmin()) {
            $a->notifications()->where('id',$id)->delete();
        }
        return response()->json(['ok' => true]);
    }
}
