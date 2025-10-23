<?php
namespace App\Models\admin;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\Product;

class Warranty extends Model
{
    protected $table = 'warranties';
    protected $primaryKey = 'warranty_id';
    public $incrementing = false;       // ✅ thêm dòng này
    protected $keyType = 'string';
    public $timestamps = false;
    

    protected $fillable = [
        'warranty_id',
        'order_item_id',
        'product_id',
        'product_serial',
        'start_date',
        'end_date',
        'status',
        'service_center',
        'notes'
    ];
    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class, 'order_item_id', 'order_item_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($warranty) {
            if (!$warranty->warranty_id) {
                $last = static::orderBy('warranty_id', 'desc')->first();
                $lastNumber = 0;

                if ($last && preg_match('/WAR_(\d+)/', $last->warranty_id, $matches)) {
                    $lastNumber = intval($matches[1]);
                }

                $warranty->warranty_id = 'WAR_' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            }
        });
    }
}
