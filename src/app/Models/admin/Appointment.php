<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $table = 'appointments'; 
    protected $primaryKey = 'appointment_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'appointment_id','user_id', 'order_id','warranty_id','service_type','appointment_date','appointment_time','status','notes'
    ];
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
    public function Order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
    public function Warranty()
    {
        return $this->belongsTo(Warranty::class, 'warranty_id', 'warranty_id');
    }
    public function scopeToday($query)
    {
        return $query->whereDate('appointment_date', now()->toDateString());
    }

}