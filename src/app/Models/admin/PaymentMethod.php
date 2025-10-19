<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $table = 'payment_methods';

    protected $primaryKey = 'method_id';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'method_id',
        'name',
        'is_active',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class, 'method_id', 'method_id');
    }
}