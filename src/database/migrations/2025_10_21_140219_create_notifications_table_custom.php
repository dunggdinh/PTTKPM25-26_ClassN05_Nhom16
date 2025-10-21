<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('notifications', function (Blueprint $t) {
            $t->uuid('id')->primary();
            $t->string('type');
            $t->string('notifiable_type');
            $t->string('notifiable_id');   // để khớp users.user_id dạng string
            $t->text('data');              // JSON payload
            $t->timestamp('read_at')->nullable();
            $t->timestamps();

            $t->index(['notifiable_type','notifiable_id']);
            $t->index('read_at');
        });
    }
    public function down(): void {
        Schema::dropIfExists('notifications');
    }
};
