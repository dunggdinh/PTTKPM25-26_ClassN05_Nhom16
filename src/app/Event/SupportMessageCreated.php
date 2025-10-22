<?php

namespace App\Event;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SupportMessageCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public int $conversationId;
    public array $message;

    public function __construct(int $conversationId, array $message)
    {
        $this->conversationId = $conversationId;
        $this->message = $message;
    }

    public function broadcastOn(): Channel
    {
        return new PrivateChannel('support.conversation.' . $this->conversationId);
    }

    // Tên event ở client (Echo) sẽ là: .SupportMessageCreated
    public function broadcastAs(): string
    {
        return 'SupportMessageCreated';
    }
}
