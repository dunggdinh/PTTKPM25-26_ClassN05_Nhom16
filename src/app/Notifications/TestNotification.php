<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TestNotification extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return ['database']; // lưu vào bảng notifications
    }

    public function toDatabase($notifiable)
    {
        return [
            'title'   => 'Thông báo thử nghiệm 🎉',
            'message' => 'Hệ thống thông báo hoạt động thành công!',
            'icon'    => 'green',
            'url'     => url('/customer/home'),
            'time'    => now()->diffForHumans(),
            'tag'     => 'test',
        ];
    }
}
