<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('import_batches')) {
            return;
        }
        Schema::create('import_batches', function (Blueprint $table) {
            $table->id('batch_id');              // khóa chính
            $table->string('supplier_id');       // nhà cung cấp
            $table->decimal('total_value', 15, 2)->default(0);
            $table->enum('status', ['pending', 'completed'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('import_batches');
    }
};
