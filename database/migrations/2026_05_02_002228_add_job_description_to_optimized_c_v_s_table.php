<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('optimized_c_v_s', function (Blueprint $table) {
            if (!Schema::hasColumn('optimized_c_v_s', 'job_description')) {
                $table->longText('job_description')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('optimized_c_v_s', function (Blueprint $table) {
            $table->dropColumn('job_description');
        });
    }
};