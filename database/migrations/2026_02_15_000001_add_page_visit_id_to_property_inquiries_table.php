<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('property_inquiries', function (Blueprint $table) {
            $table->foreignId('page_visit_id')->nullable()->after('property_id')->constrained('page_visits')->nullOnDelete();
            $table->index('page_visit_id');
        });
    }

    public function down(): void
    {
        Schema::table('property_inquiries', function (Blueprint $table) {
            $table->dropForeign(['page_visit_id']);
            $table->dropIndex(['page_visit_id']);
            $table->dropColumn('page_visit_id');
        });
    }
};
