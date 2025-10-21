<?php

namespace App\Models\customer;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users'; // bảng bạn đang dùng
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id', 
        'name', 
        'email', 
        'role', 
        'password',
        'birth_date',
        'gender',
        'phone',
        'address',
    ];

    protected $hidden = [
        'password', 
        'remember_token',
    ];

    protected $casts = [
        'birth_date' => 'date:Y-m-d',
    ];
}
