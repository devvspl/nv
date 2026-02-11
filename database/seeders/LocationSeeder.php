<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            [
                'name' => 'Downtown',
                'slug' => 'downtown',
                'description' => 'Central business district with modern amenities',
                'icon' => '🏙️',
                'status' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Suburbs',
                'slug' => 'suburbs',
                'description' => 'Quiet residential areas with family-friendly environment',
                'icon' => '🏘️',
                'status' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Waterfront',
                'slug' => 'waterfront',
                'description' => 'Properties with beautiful water views',
                'icon' => '🌊',
                'status' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Mountain View',
                'slug' => 'mountain-view',
                'description' => 'Scenic mountain locations',
                'icon' => '⛰️',
                'status' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'City Center',
                'slug' => 'city-center',
                'description' => 'Heart of the city with easy access to everything',
                'icon' => '📍',
                'status' => true,
                'sort_order' => 5,
            ],
        ];

        foreach ($locations as $location) {
            Location::create($location);
        }
    }
}
