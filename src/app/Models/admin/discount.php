<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Discount extends Model
{
    protected $table = 'discounts';
    protected $primaryKey = 'discount_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'discount_id',
        'code',          // ✅ đổi từ discount_code thành code
        'type',
        'value',
        'status',
        'start_date',
        'end_date',
        // 'description','min_order' nếu có
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date'   => 'datetime',
        'value'      => 'float',
    ];

    // Active theo NGÀY (phù hợp cột DATE)
    public function scopeActive($q)
    {
        $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        return $q->where('status', 'active')
                 ->whereDate('start_date', '<=', $today)
                 ->whereDate('end_date', '>=', $today);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'discount_products', 'discount_id', 'product_id');
    }

    public function orderDiscounts()
    {
        return $this->hasMany(OrderDiscount::class, 'discount_id', 'discount_id');
    }
}
