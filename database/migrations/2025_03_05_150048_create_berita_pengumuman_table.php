<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('berita_pengumuman', function (Blueprint $table) {
            $table->id();
            $table->string('jenis'); // Pengumuman, Berita, etc.
            $table->string('judul');
            $table->text('isi');
            $table->unsignedBigInteger('writer'); // Referensi ke `users`
            $table->timestamps();

            // Foreign Key
            $table->foreign('writer')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('berita_pengumuman');
    }
};
