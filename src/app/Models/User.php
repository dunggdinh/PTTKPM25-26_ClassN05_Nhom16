<?php

// namespace App\Models;

// // use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;

// class User extends Authenticatable
// {
//     /** @use HasFactory<\Database\Factories\UserFactory> */
//     use HasFactory, Notifiable;

//     /**
//      * The attributes that are mass assignable.
//      *
//      * @var list<string>
//      */
//     protected $fillable = [
//         'name',
//         'email',
//         'password',
//     ];

//     /**
//      * The attributes that should be hidden for serialization.
//      *
//      * @var list<string>
//      */
//     protected $hidden = [
//         'password',
//         'remember_token',
//     ];

//     /**
//      * Get the attributes that should be cast.
//      *
//      * @return array<string, string>
//      */
//     protected function casts(): array
//     {
//         return [
//             'email_verified_at' => 'datetime',
//             'password' => 'hashed',
//         ];
//     }
// }
// đừng xóa vội
// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;

// class User extends Authenticatable
// {
//     use HasFactory, Notifiable;

//     // Khóa chính là user_id (string), không auto increment
//     protected $primaryKey = 'user_id';
//     public $incrementing = false;
//     protected $keyType = 'string';

//     protected $fillable = [
//         'user_id', 'name', 'email', 'password',
//         'email_verified_at', 'remember_token',
//     ];

//     protected $hidden = ['password', 'remember_token'];

//     protected $casts = [
//         'email_verified_at' => 'datetime',
//     ];
// }
//Thử


// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Foundation\Auth\User as Authenticatable;

// class User extends Authenticatable
// {
//     use HasFactory;

//     protected $table = 'users';
//     protected $primaryKey = 'user_id';
//     public $incrementing = false;  // vì user_id không phải AUTO_INCREMENT
//     protected $keyType = 'string';

//     protected $fillable = [
//         'user_id',
//         'name',
//         'email',
//         'password',
//         'role',
//         'birth_date',
//         'gender',
//         'phone',
//         'address',
//     ];

//     protected $hidden = [
//         'password',
//     ];
// }


namespace App\Models;

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
