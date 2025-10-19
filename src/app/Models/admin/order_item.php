<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $table = 'order_items'; 
    protected $primaryKey = 'order_item_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'order_item_id','order_id','product_id','quantity','unit_price',
    ];
    public function order()
    {
        return $this->belongsTo(order::class, 'order_id', 'order_id');
    }
    public function product()
    {
        return $this->belongsTo(product::class, 'product_id', 'product_id');
    }
}