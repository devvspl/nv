<?php

namespace Database\Seeders;

use App\Models\PropertyType;
use App\Models\ServiceType;
use Illuminate\Database\Seeder;

class PropertyTypeSeeder extends Seeder
{
    public function run(): void
    {
        $propertyTypes = [
            [
                'name' => 'House',
                'slug' => 'house',
                'description' => 'Independent houses and villas',
                'icon' => '🏡',
                'status' => true,
                'sort_order' => 1,
                'service_types' => ['buy', 'lease', 'rental'], // Available for all
            ],
            [
                'name' => 'Apartment',
                'slug' => 'apartment',
                'description' => 'Apartments and flats in residential complexes',
                'icon' => '🏢',
                'status' => true,
                'sort_order' => 2,
                'service_types' => ['buy', 'lease', 'rental'],
            ],
            [
                'name' => 'Farmhouse',
                'slug' => 'farmhouse',
                'description' => 'Farmhouses with land',
                'icon' => '🌾',
                'status' => true,
                'sort_order' => 3,
                'service_types' => ['buy', 'lease'],
            ],
            [
                'name' => 'Agricultural Land',
                'slug' => 'agricultural-land',
                'description' => 'Land for agricultural purposes',
                'icon' => '🌱',
                'status' => true,
                'sort_order' => 4,
                'service_types' => ['buy', 'lease'],
            ],
            [
                'name' => 'Warehouse',
                'slug' => 'warehouse',
                'description' => 'Commercial warehouse spaces',
                'icon' => '🏭',
                'status' => true,
                'sort_order' => 5,
                'service_types' => ['buy', 'lease', 'rental'],
            ],
            [
                'name' => 'Warehouse Land',
                'slug' => 'warehouse-land',
                'description' => 'Land for warehouse development',
                'icon' => '📦',
                'status' => true,
                'sort_order' => 6,
                'service_types' => ['buy', 'lease'],
            ],
            [
                'name' => 'Office',
                'slug' => 'office',
                'description' => 'Commercial office spaces',
                'icon' => '🏢',
                'status' => true,
                'sort_order' => 7,
                'service_types' => ['buy', 'lease', 'rental'],
            ],
            [
                'name' => 'Single Room',
                'slug' => 'single-room',
                'description' => 'Single room accommodations',
                'icon' => '🚪',
                'status' => true,
                'sort_order' => 8,
                'service_types' => ['rental'], // Only for rental
            ],
        ];

        foreach ($propertyTypes as $propertyTypeData) {
            $serviceTypeSlugs = $propertyTypeData['service_types'];
            unset($propertyTypeData['service_types']);
            
            $propertyType = PropertyType::create($propertyTypeData);
            
            // Map to service types
            $serviceTypeIds = ServiceType::whereIn('slug', $serviceTypeSlugs)->pluck('id');
            $propertyType->serviceTypes()->attach($serviceTypeIds);
        }
    }
}
