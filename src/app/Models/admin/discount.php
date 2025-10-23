<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $table = 'discounts';
    protected $primaryKey = 'discount_id';
    public $incrementing = false;
    protected $keyType = 'string';

    // ⚠️ Bảng này không có cột created_at / updated_at
    public $timestamps = false;

    protected $fillable = [
        'discount_id',
        'code',
        'type',
        'value',
        'status',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];
}
