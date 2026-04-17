<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('builders', function (Blueprint $table) {
            $table->string('video_path')->nullable()->after('logo');
            $table->string('youtube_url')->nullable()->after('video_path');
        });
    }

    public function down(): void
    {
        Schema::table('builders', function (Blueprint $table) {
            $table->dropColumn(['video_path', 'youtube_url']);
        });
    }
};
