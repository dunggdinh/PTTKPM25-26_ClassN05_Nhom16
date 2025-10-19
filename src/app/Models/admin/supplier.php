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
}