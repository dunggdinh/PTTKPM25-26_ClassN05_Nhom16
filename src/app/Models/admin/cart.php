<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;
// Hãy chắc chắn đường dẫn 'use App\Models\User;' là đúng
use App\Models\customer\User; 
use Illuminate\Support\Str;

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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function items()
    {
        return $this->hasMany(CartItem::class, 'cart_id', 'cart_id');
    }
    // helper: phát sinh cart_id vừa đúng 10 ký tự như DB (VD: CART_001)
    public static function newId(): string
    {
        // CART_ + 3 số -> 8 ký tự; nếu cần đúng 10 có thể CART_ + 5 số
        return 'CART_'.str_pad((string)random_int(1, 99999), 5, '0', STR_PAD_LEFT);
    }
}