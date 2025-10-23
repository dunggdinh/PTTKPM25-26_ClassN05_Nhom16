<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers'; 
    protected $primaryKey = 'supplier_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'supplier_id','name','contact_name','phone','email','address','country',
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($supplier) {
            if (!$supplier->supplier_id) {
                $last = static::orderBy('supplier_id', 'desc')->first();
                $lastNumber = 0;

                if ($last && preg_match('/SUP_(\d+)/', $last->supplier_id, $matches)) {
                    $lastNumber = intval($matches[1]);
                }

                $supplier->supplier_id = 'SUP_' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            }
        });
    }
}