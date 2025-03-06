<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('berkas_lomba', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tim'); // Referensi ke `tim_lomba`
            $table->string('nama_file');
            $table->string('url_file');
            $table->timestamps();

            // Foreign Key
            $table->foreign('id_tim')->references('id')->on('tim_lomba')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('berkas_lomba');
    }
};

