<?php

namespace App\Models\admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\OrderItem;
use App\Models\auth\User;


class ReturnRequest extends Model
{
    use HasFactory;

    protected $table = 'returns';
    protected $primaryKey = 'return_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'return_id',
        'order_item_id',
        'customer_id',
        'type',
        'reason',
        'status',
        'requested_at',
        'processed_at',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class, 'order_item_id', 'order_item_id');
    }
}

