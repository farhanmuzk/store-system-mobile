<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->string('cash_code')->nullable()->after('image');
            $table->string('transfer_payment')->nullable()->after('cash_code');
        });
    }

    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['cash_code', 'transfer_payment']);
        });
    }
};
