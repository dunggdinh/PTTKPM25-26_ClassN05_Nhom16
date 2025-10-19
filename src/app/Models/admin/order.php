<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'order_id', 'user_id', 'total_amount', 'status',
        'shipping_address', 'created_at',
    ];

    public function customer()
    {
        return $this->belongsTo(customer::class, 'user_id', 'user_id');
    }

    public function supplier()
    {
        return $this->belongsTo(supplier::class, 'supplier_id', 'supplier_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
    }
}
