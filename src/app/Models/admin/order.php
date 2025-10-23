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
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (!$order->order_id) {
                $lastOrder = static::orderBy('order_id', 'desc')->first();
                $lastNumber = 0;

                if ($lastOrder && preg_match('/ORD_(\d+)/', $lastOrder->order_id, $matches)) {
                    $lastNumber = intval($matches[1]);
                }

                $order->order_id = 'ORD_' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            }
        });
    }
}
