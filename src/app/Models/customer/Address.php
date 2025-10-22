<?php

namespace App\Models\customer;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id',
        'address',
        'latitude',
        'longitude',
        'is_default'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}