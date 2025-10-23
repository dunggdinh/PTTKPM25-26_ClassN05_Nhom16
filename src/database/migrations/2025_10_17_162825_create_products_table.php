<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('category');
                $table->integer('stock')->default(0);
                $table->integer('min_stock')->default(5);
                $table->decimal('price', 15, 2);
                $table->string('status')->default('in-stock');
                $table->string('sku');
                $table->string('brand')->nullable();
                $table->string('model')->nullable();
                $table->string('supplier')->nullable();
                $table->string('location')->nullable();
                $table->dateTime('last_updated')->nullable();
                $table->text('description')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
}