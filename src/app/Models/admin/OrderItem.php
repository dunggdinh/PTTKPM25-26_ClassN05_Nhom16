<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';
    protected $primaryKey = 'order_item_id';
    public $incrementing = false;
    protected $keyType = 'string';

    // Nếu bảng không có created_at/updated_at:
    public $timestamps = false;
    const CREATED_AT = null;
    const UPDATED_AT = null;

    protected $fillable = [
        'order_item_id',
        'order_id',
        'product_id',
        'quantity',
        'unit_price',
    ];

    public static function newId(): string
    {
        // Tạo dạng OI_000, OI_001, ... OI_999
        $last = static::where('order_item_id', 'LIKE', 'OI\_%')
                      ->orderBy('order_item_id', 'desc')
                      ->first();
        $n = 0;
        if ($last && preg_match('/^OI_(\d{3})$/', $last->order_item_id, $m)) {
            $n = (int) $m[1];
        }
        return 'OI_' . str_pad((string) ($n + 1), 3, '0', STR_PAD_LEFT);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($item) {
            if (empty($item->order_item_id)) {
                $item->order_item_id = static::newId();
            }
        });
    }
    // ✅ Quan hệ tới Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
}
