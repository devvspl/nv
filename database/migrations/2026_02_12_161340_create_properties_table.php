<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->foreignId('property_type_id')->constrained()->restrictOnDelete();
            $table->foreignId('bhk_id')->nullable()->constrained()->restrictOnDelete();
            $table->foreignId('city_id')->constrained()->restrictOnDelete();
            $table->foreignId('location_id')->constrained()->restrictOnDelete();
            $table->foreignId('project_status_id')->constrained()->restrictOnDelete();
            $table->foreignId('builder_id')->nullable()->constrained()->nullOnDelete();
            $table->decimal('price', 15, 2);
            $table->decimal('price_per_sqft', 10, 2)->nullable();
            $table->decimal('carpet_area', 10, 2)->nullable();
            $table->decimal('built_up_area', 10, 2)->nullable();
            $table->decimal('plot_area', 10, 2)->nullable();
            $table->text('address')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('views_count')->default(0);
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes for search and filtering
            $table->index('property_type_id');
            $table->index('bhk_id');
            $table->index('city_id');
            $table->index('location_id');
            $table->index('project_status_id');
            $table->index('builder_id');
            $table->index('price');
            $table->index('is_featured');
            $table->index('is_verified');
            $table->index('is_active');
            $table->index('published_at');
            $table->index(['city_id', 'property_type_id', 'bhk_id', 'price'], 'idx_search');
        });
        
        // Add fulltext index for search
        DB::statement('ALTER TABLE properties ADD FULLTEXT idx_fulltext (title, description)');
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
