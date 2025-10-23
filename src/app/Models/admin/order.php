<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'order_id', 'user_id', 'total_amount', 'status',
        'payment_status','shipping_address', 'created_at',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function Supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'supplier_id');
    }

    public function OrderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
    }
}
