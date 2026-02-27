<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('property_page_sections', function (Blueprint $table) {
            $table->string('kicker')->nullable()->after('subtitle');
            $table->json('badges')->nullable()->after('features');
        });
    }

    public function down(): void
    {
        Schema::table('property_page_sections', function (Blueprint $table) {
            $table->dropColumn(['kicker', 'badges']);
        });
    }
};
