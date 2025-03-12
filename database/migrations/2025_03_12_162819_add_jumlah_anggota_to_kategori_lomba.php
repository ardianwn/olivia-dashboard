<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('kategori_lomba', function (Blueprint $table) {
            $table->integer('jumlah_anggota_maksimal')->default(5)->after('nama_kategori'); 
        });
    }

    public function down()
    {
        Schema::table('kategori_lomba', function (Blueprint $table) {
            $table->dropColumn('jumlah_anggota_maksimal');
        });
    }
};
