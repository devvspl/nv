<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('property_page_sections', function (Blueprint $table) {
            $table->foreignId('property_type_id')->nullable()->after('id')->constrained('property_types')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('property_page_sections', function (Blueprint $table) {
            $table->dropForeign(['property_type_id']);
            $table->dropColumn('property_type_id');
        });
    }
};
