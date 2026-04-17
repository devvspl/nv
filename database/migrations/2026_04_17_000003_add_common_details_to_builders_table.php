<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Pivot: builder <-> amenity
        Schema::create('builder_amenity', function (Blueprint $table) {
            $table->foreignId('builder_id')->constrained()->cascadeOnDelete();
            $table->foreignId('amenity_id')->constrained()->cascadeOnDelete();
            $table->primary(['builder_id', 'amenity_id']);
        });

        // Pivot: builder <-> project_status
        Schema::create('builder_project_status', function (Blueprint $table) {
            $table->foreignId('builder_id')->constrained()->cascadeOnDelete();
            $table->foreignId('project_status_id')->constrained()->cascadeOnDelete();
            $table->primary(['builder_id', 'project_status_id']);
        });

        // Property page common detail fields on builders
        Schema::table('builders', function (Blueprint $table) {
            $table->boolean('show_property_page')->default(false)->after('display_order');
            $table->string('property_page_title')->nullable()->after('show_property_page');
            $table->text('property_page_description')->nullable()->after('property_page_title');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('builder_amenity');
        Schema::dropIfExists('builder_project_status');
        Schema::table('builders', function (Blueprint $table) {
            $table->dropColumn(['show_property_page', 'property_page_title', 'property_page_description']);
        });
    }
};
