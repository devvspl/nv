<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_page_sections', function (Blueprint $table) {
            $table->id();
            $table->string('section_title')->nullable();
            $table->text('section_subtitle')->nullable();
            
            // Our Company Section
            $table->string('who_we_are_title')->nullable();
            $table->text('who_we_are_description')->nullable();
            $table->string('who_we_are_icon')->nullable();
            
            $table->string('mission_title')->nullable();
            $table->text('mission_description')->nullable();
            $table->string('mission_icon')->nullable();
            
            $table->string('vision_title')->nullable();
            $table->text('vision_description')->nullable();
            $table->string('vision_icon')->nullable();
            
            // Our Values Section
            $table->string('values_heading')->nullable();
            $table->text('values_who_we_are')->nullable();
            $table->text('values_mission')->nullable();
            $table->text('values_vision')->nullable();
            $table->text('values_teamwork')->nullable();
            
            // Team Section
            $table->string('team_section_title')->nullable();
            $table->string('team_section_heading')->nullable();
            
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_page_sections');
    }
};
