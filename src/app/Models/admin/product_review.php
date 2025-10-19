<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ProductReview extends Model
{
    protected $table = 'product_reviews';

    protected $primaryKey = 'review_id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'review_id',
        'product_id',
        'user_id',
        'order_id',
        'rating',
        'comment',
        'image_url',
        'status',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
}