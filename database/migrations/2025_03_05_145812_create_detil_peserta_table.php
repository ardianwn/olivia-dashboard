<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('detil_peserta', function (Blueprint $table) {
            $table->id();
            $table->string('nim')->unique();
            $table->string('nama_lengkap');
            $table->unsignedBigInteger('id_tim'); // Referensi ke `tim_lomba`
            $table->string('scan_ktm')->nullable();
            $table->string('no_wa');
            $table->string('foto_anggota')->nullable();
            $table->timestamps();

            // Foreign Key
            $table->foreign('id_tim')->references('id')->on('tim_lomba')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('detil_peserta');
    }
};
