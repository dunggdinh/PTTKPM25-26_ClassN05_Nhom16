<?php

// app/Notifications/LowStockInCartNotification.php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class LowStockInCartNotification extends Notification
{
    use Queueable;

    public function __construct(public string $productName, public int $left) {}

    public function via($notifiable): array { return ['database']; }

    public function toDatabase($notifiable): array
    {
        return [
            'title' => 'Sản phẩm trong giỏ hàng sắp hết',
            'message' => "{$this->productName} chỉ còn {$this->left} sản phẩm cuối cùng",
            'icon' => 'red',
            'url' => url('/customer/cart'),
            'time' => now()->diffForHumans(),
            'tag' => 'stock',
        ];
    }
}
