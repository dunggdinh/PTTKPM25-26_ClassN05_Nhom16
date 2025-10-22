<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\DB;

Broadcast::channel('support.conversation.{conversationId}', function ($user, $conversationId) {
    // 1) Admin nghe tất cả
    if (($user->role ?? null) === 'admin') {
        // có thể trả về mảng info để client dùng (không bắt buộc)
        return ['user_id' => $user->user_id, 'role' => 'admin'];
    }

    // 2) Customer chỉ nghe cuộc thuộc về mình
    $owns = DB::table('support_conversations as c')
        ->join('support_tickets as t', 't.ticket_id', '=', 'c.ticket_id')
        ->where('c.conversation_id', $conversationId)
        ->where('t.user_id', $user->user_id)
        ->exists();

    return $owns ? ['user_id' => $user->user_id, 'role' => 'customer'] : false;
});
