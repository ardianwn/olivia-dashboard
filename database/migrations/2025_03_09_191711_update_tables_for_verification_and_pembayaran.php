<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Update tabel tim_lomba
        Schema::table('tim_lomba', function (Blueprint $table) {
            $table->enum('status_verifikasi', ['pending', 'verified', 'rejected'])
                ->default('pending')
                ->after('foto_tim');
            $table->boolean('status_final_submit')->default(false)->after('status_verifikasi');
        });

        // Update tabel detil_peserta
        Schema::table('detil_peserta', function (Blueprint $table) {
            $table->enum('status_verifikasi', ['pending', 'verified', 'rejected'])
                ->default('pending')
                ->after('foto_anggota');
        });

        // Update tabel berkas_lomba
        Schema::table('berkas_lomba', function (Blueprint $table) {
            $table->enum('status_verifikasi', ['pending', 'valid', 'rejected'])
                ->default('pending')
                ->after('url_file');
        });

        // Buat tabel pembayaran_lomba
        Schema::create('pembayaran_lomba', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_tim')->constrained('tim_lomba')->onDelete('cascade');
            $table->string('bukti_pembayaran');
            $table->enum('status_verifikasi', ['pending', 'valid', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        // Rollback perubahan
        Schema::table('tim_lomba', function (Blueprint $table) {
            $table->dropColumn(['status_verifikasi', 'status_final_submit']);
        });

        Schema::table('detil_peserta', function (Blueprint $table) {
            $table->dropColumn('status_verifikasi');
        });

        Schema::table('berkas_lomba', function (Blueprint $table) {
            $table->dropColumn('status_verifikasi');
        });

        Schema::dropIfExists('pembayaran_lomba');
    }
};
