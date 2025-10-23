<?php
namespace App\Models\admin;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';
    protected $primaryKey = 'order_item_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'order_item_id', 'order_id', 'product_id', 'quantity', 'unit_price',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($item) {
            if (!$item->order_item_id) {
                $last = static::orderBy('order_item_id', 'desc')->first();
                $lastNumber = 0;

                if ($last && preg_match('/OI_(\d+)/', $last->order_item_id, $matches)) {
                    $lastNumber = intval($matches[1]);
                }

                $item->order_item_id = 'OI_' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            }
        });
    }
}
