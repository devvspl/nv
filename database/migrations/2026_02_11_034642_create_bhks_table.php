p<?php

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
        Schema::create('bhks', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // 1 BHK, 2 BHK, 3 BHK, 4+ BHK
            $table->string('value')->unique(); // 1, 2, 3, 4+
            $table->text('description')->nullable();
            $table->boolean('status')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bhks');
    }
};
