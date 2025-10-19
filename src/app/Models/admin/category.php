<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $table = 'categories'; 
    protected $primaryKey = 'category_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'category_id','name',
    ];
}