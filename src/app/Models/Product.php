<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'category', 'stock', 'min_stock', 'price', 'status',
        'sku', 'brand', 'model', 'supplier', 'location', 'last_updated', 'description'
    ];

    protected $casts = [
        'last_updated' => 'datetime',
        'price' => 'decimal:2',
    ];
}