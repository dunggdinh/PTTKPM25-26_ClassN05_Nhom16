<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\customer\User; 
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    protected $table = 'carts';
    protected $primaryKey = 'cart_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'cart_id', 
        'user_id',
    ];

    // Quan hệ user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function CartItem()
    {
        return $this->hasMany(\App\Models\admin\CartItem::class, 'cart_id', 'cart_id');
    }

    // (không bắt buộc) giữ alias để code khác gọi CartItems vẫn chạy
    public function CartItems()
    {
        return $this->CartItem();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($cart) {
            if (!$cart->cart_id) {
                DB::transaction(function () use ($cart) {
                    $lastCart = static::orderBy('cart_id', 'desc')->lockForUpdate()->first();
                    $lastNumber = 0;

                    if ($lastCart && preg_match('/CART_(\d+)/', $lastCart->cart_id, $matches)) {
                        $lastNumber = (int) $matches[1];
                    }

                    $cart->cart_id = 'CART_' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
                });
            }
        });
    }
}
