<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('property_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->string('image_path');
            $table->enum('image_type', ['main', 'gallery', 'floor_plan', 'location_map'])->default('gallery');
            $table->string('title')->nullable();
            $table->integer('display_order')->default(0);
            $table->timestamps();
            
            $table->index('property_id');
            $table->index('image_type');
            $table->index('display_order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('property_images');
    }
};
