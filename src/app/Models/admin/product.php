<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products'; 
    protected $primaryKey = 'product_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'product_id','name','brand','category_id',
        'price','rating','quantity','warranty','created_at','supplier_id',
    ];
    public function Category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
    public function Supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'supplier_id');
    }
    public function discounts()
    {
        return $this->belongsToMany(
            \App\Models\admin\Discount::class, // Model Discount
            'discount_products',               // Tên bảng trung gian
            'product_id',                      // Khóa ngoại của Product trong bảng trung gian
            'discount_id'                      // Khóa ngoại của Discount trong bảng trung gian
        );
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (!$product->product_id) {
                $last = static::orderBy('product_id', 'desc')->first();
                $lastNumber = 0;

                if ($last && preg_match('/PRD_(\d+)/', $last->product_id, $matches)) {
                    $lastNumber = intval($matches[1]);
                }

                $product->product_id = 'PRD_' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            }
        });
    }
}