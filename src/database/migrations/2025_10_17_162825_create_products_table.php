<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Nếu bảng đã có → chỉ bổ sung cột thiếu rồi return
        if (Schema::hasTable('products')) {
            Schema::table('products', function (Blueprint $t) {
                // KHÔNG dùng ->after(...) để tránh lỗi khi cột tham chiếu chưa tồn tại

                if (!Schema::hasColumn('products', 'stock')) {
                    $t->integer('stock')->default(0);
                }
                if (!Schema::hasColumn('products', 'min_stock')) {
                    $t->integer('min_stock')->default(5);
                }
                if (!Schema::hasColumn('products', 'price')) {
                    $t->decimal('price', 15, 2)->default(0);
                }
                if (!Schema::hasColumn('products', 'status')) {
                    $t->string('status')->default('in-stock');
                }
                if (!Schema::hasColumn('products', 'sku')) {
                    $t->string('sku');
                }
                if (!Schema::hasColumn('products', 'brand')) {
                    $t->string('brand')->nullable();
                }
                if (!Schema::hasColumn('products', 'model')) {
                    $t->string('model')->nullable();
                }
                if (!Schema::hasColumn('products', 'supplier')) {
                    $t->string('supplier')->nullable();
                }
                if (!Schema::hasColumn('products', 'location')) {
                    $t->string('location')->nullable();
                }
                if (!Schema::hasColumn('products', 'last_updated')) {
                    $t->dateTime('last_updated')->nullable();
                }
                if (!Schema::hasColumn('products', 'description')) {
                    $t->text('description')->nullable();
                }
                if (!Schema::hasColumn('products', 'created_at') && !Schema::hasColumn('products','updated_at')) {
                    $t->timestamps();
                }
            });

            return; // rất quan trọng
        }

        // Nếu chưa có bảng → tạo mới đầy đủ
        Schema::create('products', function (Blueprint $t) {
            $t->id();                           // hoặc đổi theo khóa chính bạn dùng thực tế
            $t->string('name');
            $t->string('category');
            $t->integer('stock')->default(0);
            $t->integer('min_stock')->default(5);
            $t->decimal('price', 15, 2);
            $t->string('status')->default('in-stock');
            $t->string('sku');
            $t->string('brand')->nullable();
            $t->string('model')->nullable();
            $t->string('supplier')->nullable();
            $t->string('location')->nullable();
            $t->dateTime('last_updated')->nullable();
            $t->text('description')->nullable();
            $t->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
