<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Modify the enum to include 'popup_inquiry'
        DB::statement("ALTER TABLE property_inquiries MODIFY COLUMN inquiry_type ENUM('site_visit', 'call_back', 'email_info', 'general', 'popup_inquiry') DEFAULT 'general'");
    }

    public function down(): void
    {
        // Revert back to original enum values
        DB::statement("ALTER TABLE property_inquiries MODIFY COLUMN inquiry_type ENUM('site_visit', 'call_back', 'email_info', 'general') DEFAULT 'general'");
    }
};
