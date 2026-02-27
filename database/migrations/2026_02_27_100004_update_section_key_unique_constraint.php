<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('property_page_sections', function (Blueprint $table) {
            // Drop the old unique constraint on section_key
            $table->dropUnique(['section_key']);
            
            // Add composite unique constraint on property_type_id and section_key
            $table->unique(['property_type_id', 'section_key'], 'property_type_section_unique');
        });
    }

    public function down(): void
    {
        Schema::table('property_page_sections', function (Blueprint $table) {
            // Drop the composite unique constraint
            $table->dropUnique('property_type_section_unique');
            
            // Restore the old unique constraint on section_key
            $table->unique('section_key');
        });
    }
};
