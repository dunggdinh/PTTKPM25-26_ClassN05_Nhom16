<?php
namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\auth\User;

class SupportMessage extends Model
{
    protected $table = 'support_messages';
    protected $primaryKey = 'message_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'message_id',
        'ticket_id',
        'sender_id',
        'sender_role',
        'content',
        'sent_at',
    ];

    public function supportTicket()
    {
        return $this->belongsTo(SupportTicket::class, 'ticket_id', 'ticket_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id', 'user_id')
                    ->select('user_id', 'name', 'role');
    }

    // 🔽 Thêm đoạn này để tự sinh message_id dạng MSG_001
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Lấy message cuối cùng theo thứ tự giảm dần
            $latest = self::orderBy('message_id', 'desc')->first();

            // Tính ID kế tiếp
            $nextId = $latest ? intval(substr($latest->message_id, 4)) + 1 : 1;

            // Gán mã mới vào model
            $model->message_id = 'MSG_' . str_pad($nextId, 3, '0', STR_PAD_LEFT);
        });
    }
}
