<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users'; 
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id','name','email','role',
        'birth_date','gender','phone','address',
    ];
}