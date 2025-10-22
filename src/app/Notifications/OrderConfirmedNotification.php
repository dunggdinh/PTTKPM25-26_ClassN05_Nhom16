<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class OrderConfirmedNotification extends Notification
{
    use Queueable;

    public function __construct(public string $orderCode, public string $productName) {}

    public function via($notifiable): array
    {
        return ['database']; // có thể thêm 'broadcast' nếu dùng realtime
    }

    public function toDatabase($notifiable): array
    {
        return [
            'title' => "Đơn hàng #{$this->orderCode} đã được xác nhận",
            'message' => "Đơn hàng {$this->productName} của bạn đã được xác nhận và đang chuẩn bị",
            'icon' => 'blue', // bạn đang dùng chấm màu → gợi ý: blue/green/red
            'url' => url("/customer/order/{$this->orderCode}"),
            'time' => now()->diffForHumans(),
            'tag' => 'order' // để front-end group/đổi icon
        ];
    }
}
