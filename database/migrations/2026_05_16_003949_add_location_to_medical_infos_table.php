<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('medical_infos', function (Blueprint $table) {
            $table->string('regency')->nullable()->after('address');
            $table->string('district')->nullable()->after('regency');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medical_infos', function (Blueprint $table) {
            $table->dropColumn(['regency', 'district']);
        });
    }
};
