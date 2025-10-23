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
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($discount) {
            if (!$discount->discount_id) {
                $last = static::orderBy('discount_id', 'desc')->first();
                $lastNumber = 0;

                if ($last && preg_match('/DC_(\d+)/', $last->discount_id, $matches)) {
                    $lastNumber = intval($matches[1]);
                }

                $discount->discount_id = 'DC_' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            }
        });
    }
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
