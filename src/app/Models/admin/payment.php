<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Payment extends Model
{
    protected $table = 'payments';

    protected $primaryKey = 'payment_id';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'payment_id',
        'order_id',
        'user_id',
        'gateway_id',
        'method_id',
        'amount',
        'status',
        'transaction_date',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function paymentGateway()
    {
        return $this->belongsTo(PaymentGateway::class, 'gateway_id', 'gateway_id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'method_id', 'method_id');
    }
}