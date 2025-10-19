<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $table = 'products'; 
    protected $primaryKey = 'product_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'product_id','name','brand','category_id',
        'price','rating','quantity','warranty','created_at','supplier_id',
    ];
    public function category()
    {
        return $this->belongsTo(category::class, 'category_id', 'category_id');
    }
    public function supplier()
    {
        return $this->belongsTo(supplier::class, 'supplier_id', 'supplier_id');
    }
}