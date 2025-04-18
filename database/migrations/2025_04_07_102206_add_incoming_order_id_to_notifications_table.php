<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->unsignedBigInteger('incoming_order_id')->nullable()->after('user_id');
            $table->foreign('incoming_order_id')->references('id')->on('incoming_orders')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropForeign(['incoming_order_id']);
            $table->dropColumn('incoming_order_id');
        });
    }

};
