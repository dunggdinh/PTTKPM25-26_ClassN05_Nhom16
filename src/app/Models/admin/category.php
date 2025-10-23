<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories'; 
    protected $primaryKey = 'category_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'category_id','name',
    ];
    public function Product()
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id');
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (!$category->category_id) {
                $lastCategory = static::orderBy('category_id', 'desc')->first();
                $lastNumber = 0;

                if ($lastCategory && preg_match('/CAT_(\d+)/', $lastCategory->category_id, $matches)) {
                    $lastNumber = intval($matches[1]);
                }

                $category->category_id = 'CAT_' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            }
        });
    }
}