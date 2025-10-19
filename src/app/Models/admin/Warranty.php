<?php
namespace App\Models\admin;
use Illuminate\Database\Eloquent\Model;

class Warranty extends Model
{
    protected $table = 'warranties';
    protected $primaryKey = 'warranty_id';
    public $timestamps = false;

    protected $fillable = [
        'warranty_id',
        'order_item_id',
        'product_serial',
        'start_date',
        'end_date',
        'status',
        'service_center',
        'notes'
    ];
}
