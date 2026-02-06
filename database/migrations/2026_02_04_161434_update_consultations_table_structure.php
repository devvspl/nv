<?php

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
        Schema::table('consultations', function (Blueprint $table) {
            // Add new fields for better form structure
            $table->string('inquiry_type')->default('consultation')->after('id'); // consultation, inquiry, etc.
            $table->string('source')->default('website')->after('inquiry_type'); // website, phone, email, etc.
            $table->string('location')->nullable()->after('property_type'); // preferred location
            $table->string('budget_range')->nullable()->after('location'); // budget range
            $table->text('requirements')->nullable()->after('message'); // specific requirements
            $table->timestamp('contacted_at')->nullable()->after('status'); // when contacted
            $table->text('admin_notes')->nullable()->after('contacted_at'); // admin internal notes
            $table->string('assigned_to')->nullable()->after('admin_notes'); // assigned agent/admin
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium')->after('assigned_to');
            
            // Add indexes for better performance
            $table->index(['status', 'created_at']);
            $table->index(['inquiry_type', 'status']);
            $table->index('priority');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('consultations', function (Blueprint $table) {
            $table->dropIndex(['status', 'created_at']);
            $table->dropIndex(['inquiry_type', 'status']);
            $table->dropIndex(['priority']);
            
            $table->dropColumn([
                'inquiry_type',
                'source',
                'location',
                'budget_range',
                'requirements',
                'contacted_at',
                'admin_notes',
                'assigned_to',
                'priority'
            ]);
        });
    }
};