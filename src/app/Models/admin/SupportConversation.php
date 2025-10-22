<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class SupportConversation extends Model
{
    protected $table = 'support_conversations';
    protected $primaryKey = 'conversation_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true; // đổi thành true nếu bạn có created_at/updated_at

    public function messages()
    {
        return $this->hasMany(SupportMessage::class, 'conversation_id', 'conversation_id')
                    ->orderBy('sent_at');
    }

    public function participants()
    {
        return $this->hasMany(SupportParticipant::class, 'conversation_id', 'conversation_id');
    }
}
