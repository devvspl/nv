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
        Schema::create('commercial_sections', function (Blueprint $table) {
            $table->id();
            $table->string('badge')->default('Commercial Expertise');
            $table->string('title');
            $table->text('subtitle');
            $table->json('points'); // Array of point objects with title and description
            $table->string('primary_button_text')->default('Request Commercial Consultation');
            $table->string('primary_button_link')->default('#contact');
            $table->string('secondary_button_text')->default('View Our Work');
            $table->string('secondary_button_link')->default('#projects');
            $table->json('gallery_images'); // Array of image objects with src, alt, and label
            $table->string('gallery_note')->default('Gallery Preview: Offices • Retail • Industrial • Investment Spaces');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commercial_sections');
    }
};