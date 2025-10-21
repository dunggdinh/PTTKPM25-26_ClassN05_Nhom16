<?php

// app/Http/Controllers/customer/NotificationController.php
namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function list(Request $request)
    {
        $user = Auth::user();
        $unreadCount = $user->unreadNotifications()->count();

        // Lấy 20 thông báo mới nhất
        $items = $user->notifications()
            ->latest()
            ->take(20)
            ->get()
            ->map(function ($n) {
                return [
                    'id' => $n->id,
                    'title' => $n->data['title'] ?? 'Thông báo',
                    'message' => $n->data['message'] ?? '',
                    'icon' => $n->data['icon'] ?? null,     // blue/green/red
                    'url' => $n->data['url'] ?? null,
                    'time' => $n->created_at->diffForHumans(),
                    'read_at' => $n->read_at,
                    'tag' => $n->data['tag'] ?? null,
                ];
            });

        return response()->json([
            'unread' => $unreadCount,
            'items' => $items,
        ]);
    }

    public function markAllRead()
    {
        $user = Auth::user();
        $user->unreadNotifications->markAsRead();

        return response()->json(['ok' => true]);
    }

    public function markOneRead(string $id)
    {
        $user = Auth::user();
        $n = $user->notifications()->where('id', $id)->first();
        if ($n && !$n->read_at) $n->markAsRead();
        return response()->json(['ok' => true]);
    }

    public function remove(string $id)
    {
        $user = Auth::user();
        $user->notifications()->where('id', $id)->delete();
        return response()->json(['ok' => true]);
    }
}

