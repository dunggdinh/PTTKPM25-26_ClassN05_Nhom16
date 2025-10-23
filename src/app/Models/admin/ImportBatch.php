<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class ImportBatch extends Model
{
    protected $table = 'import_batches';
    protected $primaryKey = 'batch_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($batch) {
            // Tự động tạo batch_id nếu chưa có
            if (!$batch->batch_id) {
                $lastBatch = static::orderBy('batch_id', 'desc')->first();
                $lastNumber = 0;
                if ($lastBatch && preg_match('/IB_(\d+)/', $lastBatch->batch_id, $matches)) {
                    $lastNumber = intval($matches[1]);
                }
                $batch->batch_id = 'IB_' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            }
        });
    }

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
