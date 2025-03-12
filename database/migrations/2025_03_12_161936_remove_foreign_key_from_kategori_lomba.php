<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('kategori_lomba', function (Blueprint $table) {
            $table->dropForeign(['departemen_id']); // Hapus foreign key
            $table->dropColumn('departemen_id'); // Hapus kolom
        });
    }

    public function down()
    {
        Schema::table('kategori_lomba', function (Blueprint $table) {
            $table->unsignedBigInteger('departemen_id')->nullable();
            $table->foreign('departemen_id')->references('id')->on('departemen_lomba')->onDelete('cascade');
        });
    }
};
