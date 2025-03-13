<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::dropIfExists('departemen_lomba');
    }

    public function down()
    {
        Schema::create('departemen_lomba', function (Blueprint $table) {
            $table->id();
            $table->string('nama_departemen');
            $table->timestamps();
        });
    }
};
