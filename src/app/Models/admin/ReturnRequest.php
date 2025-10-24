<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnRequest extends Model
{
    use HasFactory;

    protected $table = 'returns'; // hoặc 'returns' tùy bạn đặt trong MySQL
    protected $primaryKey = 'return_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;


    protected $fillable = [
        'return_id',
        'order_item_id',
        'customer_id',
        'type',
        'reason',
        'status',
        'requested_at',
    ];

    const STATUS_COMPLETED = 'Hoàn tất';
    const STATUS_APPROVED = 'Đã duyệt';
    const STATUS_PENDING = 'Chờ xử lý';
    const STATUS_REJECTED = 'Từ chối';
    // Relationships
    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class, 'order_item_id', 'order_item_id');
    }
    
    public function user()
    {
        return $this->belongsTo(user::class, 'customer_id', 'user_id');
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($returnRequest) {
            if (!$returnRequest->return_id) {
                $last = static::orderBy('return_id', 'desc')->first();
                $lastNumber = 0;

                if ($last && preg_match('/RET_(\d+)/', $last->return_id, $matches)) {
                    $lastNumber = intval($matches[1]);
                }

                $returnRequest->return_id = 'RET_' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            }
        });
    }

}


