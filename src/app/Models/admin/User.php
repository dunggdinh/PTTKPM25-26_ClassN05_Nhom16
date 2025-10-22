<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; // nếu dùng để đăng nhập
use Illuminate\Notifications\Notifiable;

class User extends Model
{
    use Notifiable;
    protected $table = 'users'; 
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id','name','email','role',
        'birth_date','gender','phone','address',
    ];
}