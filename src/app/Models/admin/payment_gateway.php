<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class PaymentGateway extends Model
{
    protected $table = 'payment_gateways';

    protected $primaryKey = 'gateway_id';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'gateway_id',
        'name',
        'region',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class, 'gateway_id', 'gateway_id');
    }
}