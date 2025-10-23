<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('discounts', function (Blueprint $t) {
            $t->string('discount_id')->primary();       // PK kiểu string
            $t->string('code')->unique();               // Mã KM
            $t->enum('type', ['percentage','fixed','shipping','bundle'])->default('percentage');
            $t->decimal('value', 12, 2)->default(0);    // % hoặc số tiền
            $t->enum('status', ['active','scheduled','expired','paused'])->default('scheduled');

            $t->dateTime('start_date')->nullable();
            $t->dateTime('end_date')->nullable();

            // Các field bạn có trong form
            $t->unsignedInteger('usage_limit')->nullable();
            $t->unsignedBigInteger('min_order_value')->nullable();
            $t->boolean('is_public')->default(false);
            $t->text('description')->nullable();

            $t->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('discounts');
    }
};
