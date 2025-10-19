<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Warranty extends Model
{
    protected $table = 'warranties';

    protected $primaryKey = 'warranty_id';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'warranty_id',
        'order_item_id',
        'product_serial',
        'start_date',
        'end_date',
        'status',
        'service_center',
        'notes',
    ];

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class, 'order_item_id', 'order_item_id');
    }
}