<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $table = 'discounts';
    protected $primaryKey = 'discount_id';
    public $incrementing = false;
    protected $keyType = 'string';

    // ⚠️ Bảng này không có cột created_at / updated_at
    public $timestamps = false;

    protected $fillable = [
        'discount_id',
        'code',
        'type',
        'value',
        'status',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($discount) {
            if (!$discount->discount_id) {
                // Lấy bản ghi cuối có dạng DC_### đúng định dạng
                $last = static::where('discount_id', 'REGEXP', '^DC_[0-9]+$')
                            ->orderBy('discount_id', 'desc')
                            ->first();

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
