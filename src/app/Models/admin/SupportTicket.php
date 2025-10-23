<?php

// namespace App\Models\admin;

// use Illuminate\Database\Eloquent\Model;
// use App\Models\User;

// class SupportTicket extends Model
// {
//     protected $table = 'support_tickets';

//     protected $primaryKey = 'ticket_id';

//     public $incrementing = false;

//     protected $keyType = 'string';

//     protected $fillable = [
//         'ticket_id',
//         'user_id',
//         'order_id',
//         'subject',
//         'message',
//         'status',
//     ];

//     public function user()
//     {
//         return $this->belongsTo(User::class, 'user_id', 'user_id');
//     }

//     public function order()
//     {
//         return $this->belongsTo(Order::class, 'order_id', 'order_id');
//     }

//     public function messages()
//     {
//         return $this->hasMany(SupportMessage::class, 'ticket_id', 'ticket_id');
//     }
// }

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\admin\Order;

class SupportTicket extends Model
{
    protected $table = 'support_tickets';
    protected $primaryKey = 'ticket_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'ticket_id',
        'user_id',
        'order_id',
        'name',
        'email',
        'phone',
        'issue_type',
        'priority',
        'subject',
        'description',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
}
