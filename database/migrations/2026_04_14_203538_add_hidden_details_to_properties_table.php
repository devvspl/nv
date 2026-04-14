<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->longText('hidden_details')->nullable()->after('description');
            $table->boolean('show_hidden_details')->default(false)->after('hidden_details');
        });
    }

    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn(['hidden_details', 'show_hidden_details']);
        });
    }
};
