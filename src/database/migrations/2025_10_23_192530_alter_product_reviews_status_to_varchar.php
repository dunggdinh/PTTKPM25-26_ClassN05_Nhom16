<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('product_reviews', function (Blueprint $table) {
            // chuyển cột status thành VARCHAR(50)
            $table->string('status', 50)->default('pending')->change();
        });
    }

    public function down(): void
    {
        Schema::table('product_reviews', function (Blueprint $table) {
            // Nếu muốn rollback, có thể quay về kiểu tinyint
            $table->tinyInteger('status')->default(0)->change();
        });
    }
};
