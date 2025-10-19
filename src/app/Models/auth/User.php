<?php
namespace App\Models\auth;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id','name','email','password','role',
        'birth_date','gender','phone','address',
    ];

    protected $hidden = ['password', 'remember_token'];
}
