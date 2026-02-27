<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\PropertyType;
use App\Models\PropertyPageSection;

return new class extends Migration
{
    public function up(): void
    {
        // Link existing sections to residential property type
        $residential = PropertyType::where('category', 'residential')->first();
        
        if ($residential) {
            PropertyPageSection::whereNull('property_type_id')
                ->update(['property_type_id' => $residential->id]);
        }
    }

    public function down(): void
    {
        // Set property_type_id back to null for sections
        PropertyPageSection::whereNotNull('property_type_id')
            ->update(['property_type_id' => null]);
    }
};
