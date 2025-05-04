<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('money_supplies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama_id');
            $table->string('no_telp');
            $table->date('tanggal');
            $table->enum('payment_method', ['cash', 'transfer']);
            $table->string('nomor_tf')->nullable();
            $table->text('note')->nullable();
            $table->text('message_admin')->nullable();
            $table->string('image_payment')->nullable();
            $table->string('image_feedback')->nullable();
            $table->enum('type_payment', ['pending', 'processing', 'completed'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('money_supplies');
    }
};
