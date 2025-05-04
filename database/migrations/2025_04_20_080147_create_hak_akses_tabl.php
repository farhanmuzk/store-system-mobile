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
        Schema::create('hak_akses', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->string('link')->nullable();
            $table->string('no_wa')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hak_akses');
    }

};
