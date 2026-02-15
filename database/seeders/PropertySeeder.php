<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\City;
use App\Models\Location;
use App\Models\PropertyType;
use App\Models\Bhk;
use App\Models\Builder;
use App\Models\ProjectStatus;
use Illuminate\Support\Str;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get IDs for relationships
        $cities = City::pluck('id')->toArray();
        $locations = Location::pluck('id')->toArray();
        $propertyTypes = PropertyType::pluck('id')->toArray();
        $bhks = Bhk::pluck('id')->toArray();
        $builders = Builder::pluck('id')->toArray();
        $projectStatuses = ProjectStatus::pluck('id')->toArray();
        
        // Get first user ID (admin)
        $userId = \App\Models\User::first()->id ?? 1;

        // Check if we have required data
        if (empty($cities) || empty($propertyTypes) || empty($bhks)) {
            $this->command->error('Please seed Cities, Property Types, and BHKs first!');
            return;
        }

        $properties = [
            [
                'title' => 'Aranya Heights',
                'description' => 'Experience luxury living at Aranya Heights, a premium residential project featuring modern architecture and world-class amenities. Located in the heart of Gurgaon, this property offers spacious 3 BHK apartments with stunning views and excellent connectivity.',
                'price' => 15500000,
                'carpet_area' => 1650,
                'built_up_area' => 1850,
                'address' => 'Sector 82, Gurgaon',
                'is_featured' => true,
                'is_verified' => true,
            ],
            [
                'title' => 'Lush Residency Floors',
                'description' => 'Discover the perfect blend of comfort and elegance at Lush Residency Floors. These independent builder floors in South Delhi offer spacious 4 BHK layouts with private terraces, modern amenities, and a prime location.',
                'price' => 32000000,
                'carpet_area' => 2800,
                'built_up_area' => 3200,
                'address' => 'Greater Kailash, South Delhi',
                'is_featured' => true,
                'is_verified' => true,
            ],
            [
                'title' => 'Skyline Avenue',
                'description' => 'Skyline Avenue presents contemporary 2 BHK apartments in Noida with excellent connectivity to major business hubs. Enjoy modern amenities including swimming pool, gym, and landscaped gardens.',
                'price' => 9800000,
                'carpet_area' => 1100,
                'built_up_area' => 1250,
                'address' => 'Sector 137, Noida',
                'is_featured' => true,
                'is_verified' => true,
            ],
            [
                'title' => 'Palm Grove Villas',
                'description' => 'Luxurious 4 BHK villas in Dwarka offering independent living with private gardens, parking, and 24/7 security. Perfect for families seeking spacious homes in a gated community.',
                'price' => 24500000,
                'carpet_area' => 2500,
                'built_up_area' => 2800,
                'plot_area' => 3500,
                'address' => 'Sector 23, Dwarka',
                'is_featured' => true,
                'is_verified' => true,
            ],
            [
                'title' => 'Greenfield Plots',
                'description' => 'Premium residential plots in Ghaziabad with clear titles and excellent infrastructure. Build your dream home in this well-planned gated community with wide roads, parks, and water supply.',
                'price' => 6200000,
                'plot_area' => 2000,
                'address' => 'Indirapuram, Ghaziabad',
                'is_featured' => false,
                'is_verified' => true,
            ],
            [
                'title' => 'Crown City Towers',
                'description' => 'Modern 3 BHK apartments in Noida with smart home features, clubhouse, and excellent connectivity. Under construction project with possession in 2026.',
                'price' => 13500000,
                'carpet_area' => 1450,
                'built_up_area' => 1650,
                'address' => 'Sector 150, Noida',
                'is_featured' => true,
                'is_verified' => true,
            ],
            [
                'title' => 'Royal Enclave',
                'description' => 'Elegant 2 BHK apartments in Gurgaon offering affordable luxury with modern amenities. Ready to move property with immediate possession available.',
                'price' => 8500000,
                'carpet_area' => 950,
                'built_up_area' => 1100,
                'address' => 'Sector 89, Gurgaon',
                'is_featured' => false,
                'is_verified' => true,
            ],
            [
                'title' => 'Sunrise Apartments',
                'description' => 'Spacious 3 BHK apartments in Noida with excellent ventilation and natural light. Features include modular kitchen, wooden flooring, and premium fixtures.',
                'price' => 11200000,
                'carpet_area' => 1250,
                'built_up_area' => 1450,
                'address' => 'Sector 76, Noida',
                'is_featured' => false,
                'is_verified' => true,
            ],
            [
                'title' => 'Paradise Homes',
                'description' => 'Luxury 4 BHK penthouses in South Delhi with private terrace, jacuzzi, and panoramic city views. Premium location with easy access to shopping and dining.',
                'price' => 45000000,
                'carpet_area' => 3500,
                'built_up_area' => 4000,
                'address' => 'Hauz Khas, South Delhi',
                'is_featured' => true,
                'is_verified' => true,
            ],
            [
                'title' => 'Green Valley Residency',
                'description' => 'Eco-friendly 2 BHK apartments in Ghaziabad with rainwater harvesting, solar panels, and green spaces. Affordable housing with modern amenities.',
                'price' => 5800000,
                'carpet_area' => 850,
                'built_up_area' => 950,
                'address' => 'Vaishali, Ghaziabad',
                'is_featured' => false,
                'is_verified' => true,
            ],
            [
                'title' => 'Metro View Apartments',
                'description' => 'Conveniently located 3 BHK apartments near metro station in Dwarka. Perfect for working professionals with easy connectivity to airport and business districts.',
                'price' => 12800000,
                'carpet_area' => 1350,
                'built_up_area' => 1550,
                'address' => 'Sector 12, Dwarka',
                'is_featured' => false,
                'is_verified' => true,
            ],
            [
                'title' => 'Silver Oak Villas',
                'description' => 'Premium 5 BHK villas in Gurgaon with private pool, home theater, and landscaped gardens. Ultra-luxury living for discerning buyers.',
                'price' => 65000000,
                'carpet_area' => 4800,
                'built_up_area' => 5500,
                'plot_area' => 7000,
                'address' => 'Golf Course Road, Gurgaon',
                'is_featured' => true,
                'is_verified' => true,
            ],
            [
                'title' => 'Urban Heights',
                'description' => 'Contemporary 1 BHK studio apartments in Noida perfect for young professionals and investors. Compact design with efficient space utilization.',
                'price' => 4200000,
                'carpet_area' => 550,
                'built_up_area' => 650,
                'address' => 'Sector 62, Noida',
                'is_featured' => false,
                'is_verified' => true,
            ],
            [
                'title' => 'Heritage Mansion',
                'description' => 'Restored heritage property converted into luxury 3 BHK apartments in South Delhi. Blend of classic architecture with modern amenities.',
                'price' => 28000000,
                'carpet_area' => 1950,
                'built_up_area' => 2200,
                'address' => 'Safdarjung Enclave, South Delhi',
                'is_featured' => true,
                'is_verified' => true,
            ],
            [
                'title' => 'Tech Park Residency',
                'description' => 'Smart 2 BHK apartments near IT parks in Noida with high-speed internet, co-working spaces, and modern amenities. Ideal for tech professionals.',
                'price' => 9500000,
                'carpet_area' => 1050,
                'built_up_area' => 1200,
                'address' => 'Sector 132, Noida',
                'is_featured' => false,
                'is_verified' => true,
            ],
        ];

        foreach ($properties as $index => $propertyData) {
            $slug = Str::slug($propertyData['title']);
            
            Property::create([
                'title' => $propertyData['title'],
                'slug' => $slug,
                'description' => $propertyData['description'],
                'price' => $propertyData['price'],
                'carpet_area' => $propertyData['carpet_area'] ?? null,
                'built_up_area' => $propertyData['built_up_area'] ?? null,
                'plot_area' => $propertyData['plot_area'] ?? null,
                'price_per_sqft' => isset($propertyData['built_up_area']) ? round($propertyData['price'] / $propertyData['built_up_area'], 2) : null,
                'address' => $propertyData['address'],
                'city_id' => $cities[array_rand($cities)],
                'location_id' => !empty($locations) ? $locations[array_rand($locations)] : $locations[0] ?? 1,
                'property_type_id' => $propertyTypes[array_rand($propertyTypes)],
                'bhk_id' => $bhks[array_rand($bhks)],
                'builder_id' => !empty($builders) ? $builders[array_rand($builders)] : null,
                'project_status_id' => !empty($projectStatuses) ? $projectStatuses[array_rand($projectStatuses)] : $projectStatuses[0] ?? 1,
                'user_id' => $userId,
                'is_active' => true,
                'is_featured' => $propertyData['is_featured'],
                'is_verified' => $propertyData['is_verified'],
                'published_at' => now()->subDays(rand(1, 30)),
                'views_count' => rand(50, 500),
            ]);
        }

        $this->command->info('15 properties created successfully!');
    }
}
