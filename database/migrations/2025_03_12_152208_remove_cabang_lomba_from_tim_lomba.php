<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('tim_lomba', function (Blueprint $table) {
            $table->dropColumn('cabang_lomba');
        });
    }

    public function down()
    {
        Schema::table('tim_lomba', function (Blueprint $table) {
            $table->string('cabang_lomba')->after('nama_kampus');
        });
    }
};
