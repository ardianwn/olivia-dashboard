<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('ketua_tim')->change();
            $table->string('status')->default('active')->change();
        });
    }

    public function down() {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->change();
            $table->string('status')->change();
        });
    }
};
