<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('money_supplies', function (Blueprint $table) {
            $table->string('image_bukti')->nullable();
            $table->string('image_bukti_balik')->nullable();
            $table->string('type_payment')->nullable();
        });
    }

    public function down(): void {
        Schema::table('money_supplies', function (Blueprint $table) {
            $table->dropColumn(['image_bukti', 'image_bukti_balik', 'type_payment']);
        });
    }
};
