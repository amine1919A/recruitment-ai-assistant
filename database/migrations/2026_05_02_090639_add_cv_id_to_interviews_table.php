<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('interviews', function (Blueprint $table) {
            $table->foreignId('cv_id')->nullable()->after('user_id')->constrained()->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('interviews', function (Blueprint $table) {
            $table->dropForeign(['cv_id']);
            $table->dropColumn('cv_id');
        });
    }
};