<?php
namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $table = 'cart_items';

    protected $primaryKey = 'cart_item_id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'cart_item_id', 
        'cart_id', 
        'product_id', 
        'quantity',
    ];

    protected $with = ['product']; // auto load product để render UI

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id', 'cart_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
    public static function newId(): string
    {
        return 'CI_'.str_pad((string)random_int(1, 99999), 5, '0', STR_PAD_LEFT);
    }
}