<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class ImportBatch extends Model
{
    protected $table = 'import_batches';
    protected $primaryKey = 'batch_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'batch_id', 'supplier_id', 'product_id',
        'quantity', 'price', 'total_value', 'status', 'created_at'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'supplier_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
