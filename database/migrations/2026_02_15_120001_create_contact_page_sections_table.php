<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_page_sections', function (Blueprint $table) {
            $table->id();
            $table->string('section_key')->unique(); // banner, contact_section, inquiry_section
            $table->string('heading')->nullable();
            $table->string('subheading')->nullable();
            $table->text('description')->nullable();
            $table->string('banner_image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_page_sections');
    }
};
