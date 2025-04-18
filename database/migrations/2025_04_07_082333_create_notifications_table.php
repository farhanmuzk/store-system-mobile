<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->uuid('token')->unique(); // token UUID unik
            $table->timestamp('notification_time'); // waktu notifikasi
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // relasi ke users
            $table->enum('type', ['notification', 'notification_order']); // enum tipe notifikasi
            $table->string('image')->nullable(); // opsional
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // status notifikasi
            $table->text('noted')->nullable(); // catatan
            $table->text('noted_plus')->nullable(); // catatan tambahan
            $table->timestamps(); // created_at dan updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
