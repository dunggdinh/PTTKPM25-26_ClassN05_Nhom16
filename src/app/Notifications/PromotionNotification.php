<?php

// app/Notifications/PromotionNotification.php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PromotionNotification extends Notification
{
    use Queueable;

    public function __construct(public string $titleText, public string $desc) {}

    public function via($notifiable): array { return ['database']; }

    public function toDatabase($notifiable): array
    {
        return [
            'title' => $this->titleText,                    // "Khuyến mãi đặc biệt 50% OFF"
            'message' => $this->desc,                      // "Giảm giá lên đến 50%..."
            'icon' => 'green',
            'url' => url('/customer/promotion'),
            'time' => now()->diffForHumans(),
            'tag' => 'promo',
        ];
    }
}
