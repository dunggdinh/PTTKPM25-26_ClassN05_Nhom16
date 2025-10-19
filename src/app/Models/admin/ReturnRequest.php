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

    protected $fillable = [
        'return_id',
        'order_item_id',
        'reason',
        'status',
        'requested_at',
        'processed_at',
    ];
    // Liên kết với bảng order_item (nếu có)
    public function orderItem()
    {
        return $this->belongsTo(order_item::class, 'order_item_id', 'order_item_id');
    }
}
