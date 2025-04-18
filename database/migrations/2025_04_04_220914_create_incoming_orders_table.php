<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('incoming_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('product');
            $table->integer('quantity');
            $table->string('customer_name');
            $table->text('address');
            $table->string('rt_rw');
            $table->string('district');
            $table->string('regency');
            $table->string('province');
            $table->string('phone_number');
            $table->string('payment_method');
            $table->decimal('total', 15, 2);
            $table->string('estimation')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incoming_orders');
    }
};
