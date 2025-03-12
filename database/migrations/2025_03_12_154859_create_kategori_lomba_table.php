<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('kategori_lomba', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori');
            $table->unsignedBigInteger('departemen_id'); // Relasi ke departemen_lomba
            $table->timestamps();

            // Foreign Key Constraint
            $table->foreign('departemen_id')->references('id')->on('departemen_lomba')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kategori_lomba');
    }
};
