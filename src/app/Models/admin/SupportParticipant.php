<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class SupportParticipant extends Model
{
    protected $table = 'support_participants';
    protected $fillable = ['conversation_id', 'user_id', 'role', 'last_read_at'];
    public $timestamps = false;

    public function conversation()
    {
        return $this->belongsTo(SupportConversation::class, 'conversation_id', 'conversation_id');
    }

    public function user()
    {
        // users.user_id là VARCHAR(10)
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
