<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\customer\User as CustomerUser;


class ProductReview extends Model
{
    protected $table = 'product_reviews';

    protected $primaryKey = 'review_id';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

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
        return $this->belongsTo(CustomerUser::class, 'user_id', 'user_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($review) {
            if (!$review->review_id) {
                $last = static::orderBy('review_id', 'desc')->first();
                $lastNumber = 0;

                if ($last && preg_match('/REV_(\d+)/', $last->review_id, $matches)) {
                    $lastNumber = intval($matches[1]);
                }

                $review->review_id = 'REV_' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            }
        });
    }
}