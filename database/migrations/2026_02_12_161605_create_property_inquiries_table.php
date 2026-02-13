<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('property_inquiries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('email');
            $table->string('phone', 20);
            $table->text('message')->nullable();
            $table->enum('inquiry_type', ['site_visit', 'call_back', 'email_info', 'general'])->default('general');
            $table->enum('status', ['pending', 'contacted', 'interested', 'not_interested', 'closed'])->default('pending');
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();
            
            $table->index('property_id');
            $table->index('status');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('property_inquiries');
    }
};
