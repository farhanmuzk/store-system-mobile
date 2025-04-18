<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('money_supplies', function (Blueprint $table) {
            $table->id();
            $table->string('nama_id');
            $table->string('no_telp');
            $table->date('tanggal');
            $table->string('payment_method');
            $table->string('nomor_tf')->nullable(); // hanya diisi jika payment method transfer
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('money_supplies');
    }
};
