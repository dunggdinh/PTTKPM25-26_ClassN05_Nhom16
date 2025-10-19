<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = 'discounts';

    protected $primaryKey = 'discount_id';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'discount_id',
        'discount_code',
        'type',
        'value',
        'status',
        'start_date',
        'end_date',
    ];

    public function orderDiscounts()
    {
        return $this->hasMany(OrderDiscount::class, 'discount_id', 'discount_id');
    }
}