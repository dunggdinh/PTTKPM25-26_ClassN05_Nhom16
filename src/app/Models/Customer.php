<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone', 'address', 'status', 'total_orders', 'last_order_date', 'notes'
    ];

    protected $casts = [
        'last_order_date' => 'datetime',
        'total_orders' => 'integer',
    ];
}