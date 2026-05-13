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
        Schema::table('children', function (Blueprint $table) {
            $table->text('address')->nullable()->after('birth_date');
            $table->text('special_needs')->nullable()->after('address');
            
            // Parent/Guardian Data
            $table->string('parent_name')->nullable()->after('special_needs');
            $table->string('parent_phone')->nullable()->after('parent_name');
            $table->string('parent_job')->nullable()->after('parent_phone');
            $table->text('parent_address')->nullable()->after('parent_job');
            
            // Education & Therapy
            $table->string('school_status')->nullable()->after('parent_address');
            $table->string('school_type')->nullable()->after('school_status');
            $table->text('therapies')->nullable()->after('school_type');
            $table->text('development_notes')->nullable()->after('therapies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('children', function (Blueprint $table) {
            $table->dropColumn([
                'address', 'special_needs', 'parent_name', 'parent_phone', 
                'parent_job', 'parent_address', 'school_status', 'school_type', 
                'therapies', 'development_notes'
            ]);
        });
    }
};
