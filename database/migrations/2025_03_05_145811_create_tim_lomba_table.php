<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('tim_lomba', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tim');
            $table->string('nama_kampus');
            $table->string('cabang_lomba');
            $table->string('foto_tim')->nullable();
            $table->unsignedBigInteger('id_ketua'); // Referensi ke `users`
            $table->timestamps();

            // Foreign Key
            $table->foreign('id_ketua')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('tim_lomba');
    }
};

