<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class OrderDiscount extends Model
{
    protected $table = 'order_discounts';

    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'discount_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class, 'discount_id', 'discount_id');
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($odc) {
            if (!$odc->order_discount_id) {
                $last = static::orderBy('order_discount_id', 'desc')->first();
                $lastNumber = 0;

                if ($last && preg_match('/ODC_(\d+)/', $last->order_discount_id, $matches)) {
                    $lastNumber = intval($matches[1]);
                }

                $odc->order_discount_id = 'ODC_' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            }
        });
    }
}