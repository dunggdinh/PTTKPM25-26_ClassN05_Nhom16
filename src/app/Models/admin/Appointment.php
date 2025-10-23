<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\auth\User;
use App\Models\admin\Warranty;

class Appointment extends Model
{
    protected $table = 'appointments'; 
    protected $primaryKey = 'appointment_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'appointment_id','user_id', 'order_id','warranty_id','service_type','appointment_date','appointment_time','status','notes'
    ];
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
    public function warranty()
    {
        return $this->belongsTo(\App\Models\admin\Warranty::class, 'warranty_id', 'warranty_id');
    }
    public function scopeToday($query)
    {
        return $query->whereDate('appointment_date', now()->toDateString());
    }

    /**
     * Auto-generate appointment_id in format OI_001 when creating records
     */
    protected static function booted()
    {
        static::creating(function ($model) {
            $pk = $model->getKeyName();
            if (empty($model->{$pk})) {
                $prefix = 'OI_';

                // Fetch matching ids and compute max numeric suffix in PHP (DB portability)
                $ids = DB::table($model->getTable())
                    ->where($pk, 'like', $prefix . '%')
                    ->pluck($pk)
                    ->toArray();

                $max = 0;
                foreach ($ids as $id) {
                    // Extract digits from the end of the ID
                    preg_match('/(\d+)$/', $id, $m);
                    if (!empty($m[1])) {
                        $num = intval($m[1]);
                        if ($num > $max) $max = $num;
                    }
                }

                $next = $max + 1;
                $model->{$pk} = $prefix . str_pad($next, 3, '0', STR_PAD_LEFT);
            }
        });
    }

}