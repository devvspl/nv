<?php

namespace Database\Seeders;

use App\Models\Amenity;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AmenitySeeder extends Seeder
{
    public function run(): void
    {
        $amenities = [
            // Basic Amenities
            ['name' => 'Power Backup', 'icon' => '⚡', 'category' => 'basic'],
            ['name' => 'Lift', 'icon' => '🛗', 'category' => 'basic'],
            ['name' => 'Water Supply', 'icon' => '💧', 'category' => 'basic'],
            ['name' => 'Parking', 'icon' => '🅿️', 'category' => 'basic'],
            ['name' => 'Maintenance Staff', 'icon' => '👷', 'category' => 'basic'],
            
            // Security
            ['name' => '24x7 Security', 'icon' => '🔒', 'category' => 'security'],
            ['name' => 'CCTV Surveillance', 'icon' => '📹', 'category' => 'security'],
            ['name' => 'Intercom', 'icon' => '📞', 'category' => 'security'],
            ['name' => 'Fire Safety', 'icon' => '🧯', 'category' => 'security'],
            ['name' => 'Gated Community', 'icon' => '🚧', 'category' => 'security'],
            
            // Recreation
            ['name' => 'Swimming Pool', 'icon' => '🏊', 'category' => 'recreation'],
            ['name' => 'Gym', 'icon' => '💪', 'category' => 'recreation'],
            ['name' => 'Club House', 'icon' => '🏛️', 'category' => 'recreation'],
            ['name' => 'Children Play Area', 'icon' => '🎪', 'category' => 'recreation'],
            ['name' => 'Indoor Games', 'icon' => '🎮', 'category' => 'recreation'],
            ['name' => 'Jogging Track', 'icon' => '🏃', 'category' => 'recreation'],
            ['name' => 'Sports Facility', 'icon' => '⚽', 'category' => 'recreation'],
            
            // Convenience
            ['name' => 'Shopping Center', 'icon' => '🛒', 'category' => 'convenience'],
            ['name' => 'ATM', 'icon' => '🏧', 'category' => 'convenience'],
            ['name' => 'Visitor Parking', 'icon' => '🚗', 'category' => 'convenience'],
            ['name' => 'Multipurpose Hall', 'icon' => '🏢', 'category' => 'convenience'],
            ['name' => 'Laundry Service', 'icon' => '🧺', 'category' => 'convenience'],
            
            // Eco Friendly
            ['name' => 'Rain Water Harvesting', 'icon' => '🌧️', 'category' => 'eco_friendly'],
            ['name' => 'Solar Panels', 'icon' => '☀️', 'category' => 'eco_friendly'],
            ['name' => 'Waste Management', 'icon' => '♻️', 'category' => 'eco_friendly'],
            ['name' => 'Garden', 'icon' => '🌳', 'category' => 'eco_friendly'],
        ];

        foreach ($amenities as $index => $amenity) {
            Amenity::create([
                ...$amenity,
                'slug' => Str::slug($amenity['name']),
                'status' => true,
                'display_order' => $index + 1,
            ]);
        }
    }
}
