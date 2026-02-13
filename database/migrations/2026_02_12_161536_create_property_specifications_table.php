<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('property_specifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->unique()->constrained()->cascadeOnDelete();
            $table->integer('total_floors')->nullable();
            $table->integer('floor_number')->nullable();
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->integer('balconies')->nullable();
            $table->integer('parking_spaces')->nullable();
            $table->enum('furnishing_status', ['unfurnished', 'semi_furnished', 'fully_furnished'])->nullable();
            $table->enum('facing', ['north', 'south', 'east', 'west', 'north_east', 'north_west', 'south_east', 'south_west'])->nullable();
            $table->integer('age_of_property')->nullable()->comment('in years');
            $table->date('possession_date')->nullable();
            $table->string('rera_id', 100)->nullable();
            $table->timestamps();
            
            $table->index('furnishing_status');
            $table->index('facing');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('property_specifications');
    }
};
