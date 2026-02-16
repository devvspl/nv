<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\PropertySpecification;
use App\Models\PropertyFaq;
use App\Models\City;
use App\Models\Location;
use App\Models\PropertyType;
use App\Models\Bhk;
use App\Models\Builder;
use App\Models\ProjectStatus;
use App\Models\Amenity;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

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
        $amenities = Amenity::pluck('id')->toArray();
        
        // Get first user ID (admin)
        $userId = \App\Models\User::first()->id ?? 1;

        // Check if we have required data
        if (empty($cities) || empty($propertyTypes) || empty($bhks)) {
            $this->command->error('Please seed Cities, Property Types, and BHKs first!');
            return;
        }

        // Ensure storage directory exists
        if (!Storage::exists('public/properties')) {
            Storage::makeDirectory('public/properties');
        }

        $properties = [
            [
                'title' => 'Aranya Heights',
                'description' => 'Experience luxury living at Aranya Heights, a premium residential project featuring modern architecture and world-class amenities. Located in the heart of Gurgaon, this property offers spacious 3 BHK apartments with stunning views and excellent connectivity to major business hubs, shopping centers, and educational institutions.',
                'price' => 15500000,
                'carpet_area' => 1650,
                'built_up_area' => 1850,
                'address' => 'Sector 82, Gurgaon',
                'is_featured' => true,
                'is_verified' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=800',
                    'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=800',
                    'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=800',
                    'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=800',
                ],
                'specifications' => [
                    ['label' => 'Bedrooms', 'value' => '3'],
                    ['label' => 'Bathrooms', 'value' => '3'],
                    ['label' => 'Balconies', 'value' => '2'],
                    ['label' => 'Parking', 'value' => '2 Covered'],
                    ['label' => 'Flooring', 'value' => 'Vitrified Tiles'],
                    ['label' => 'Facing', 'value' => 'North-East'],
                ],
                'faqs' => [
                    ['question' => 'What is the possession date?', 'answer' => 'Ready to move property with immediate possession available.'],
                    ['question' => 'Are pets allowed?', 'answer' => 'Yes, pets are allowed with society approval.'],
                    ['question' => 'What are the maintenance charges?', 'answer' => 'Approximately ₹4,500 per month including water and common area maintenance.'],
                ],
            ],
            [
                'title' => 'Lush Residency Floors',
                'description' => 'Discover the perfect blend of comfort and elegance at Lush Residency Floors. These independent builder floors in South Delhi offer spacious 4 BHK layouts with private terraces, modern amenities, and a prime location. Each floor is designed with attention to detail, featuring premium fittings, modular kitchens, and ample natural light.',
                'price' => 32000000,
                'carpet_area' => 2800,
                'built_up_area' => 3200,
                'address' => 'Greater Kailash, South Delhi',
                'is_featured' => true,
                'is_verified' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800',
                    'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=800',
                    'https://images.unsplash.com/photo-1600573472550-8090b5e0745e?w=800',
                    'https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?w=800',
                ],
                'specifications' => [
                    ['label' => 'Bedrooms', 'value' => '4'],
                    ['label' => 'Bathrooms', 'value' => '4'],
                    ['label' => 'Balconies', 'value' => '3'],
                    ['label' => 'Parking', 'value' => '3 Covered'],
                    ['label' => 'Flooring', 'value' => 'Italian Marble'],
                    ['label' => 'Facing', 'value' => 'South'],
                ],
                'faqs' => [
                    ['question' => 'Is this a freehold property?', 'answer' => 'Yes, this is a freehold property with clear title.'],
                    ['question' => 'What is the age of construction?', 'answer' => 'Brand new construction completed in 2024.'],
                ],
            ],
            [
                'title' => 'Skyline Avenue',
                'description' => 'Skyline Avenue presents contemporary 2 BHK apartments in Noida with excellent connectivity to major business hubs. Enjoy modern amenities including swimming pool, gym, landscaped gardens, children\'s play area, and 24/7 security. The project is strategically located near metro station and expressway.',
                'price' => 9800000,
                'carpet_area' => 1100,
                'built_up_area' => 1250,
                'address' => 'Sector 137, Noida',
                'is_featured' => true,
                'is_verified' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1600607687644-c7171b42498b?w=800',
                    'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?w=800',
                    'https://images.unsplash.com/photo-1600607688969-a5bfcd646154?w=800',
                    'https://images.unsplash.com/photo-1600607688960-e095ff83135c?w=800',
                ],
                'specifications' => [
                    ['label' => 'Bedrooms', 'value' => '2'],
                    ['label' => 'Bathrooms', 'value' => '2'],
                    ['label' => 'Balconies', 'value' => '1'],
                    ['label' => 'Parking', 'value' => '1 Covered'],
                    ['label' => 'Flooring', 'value' => 'Wooden Laminate'],
                    ['label' => 'Facing', 'value' => 'East'],
                ],
                'faqs' => [
                    ['question' => 'Is home loan available?', 'answer' => 'Yes, we have tie-ups with major banks for easy home loan processing.'],
                    ['question' => 'What is the booking amount?', 'answer' => '10% of the property value as booking amount.'],
                ],
            ],
            [
                'title' => 'Palm Grove Villas',
                'description' => 'Luxurious 4 BHK villas in Dwarka offering independent living with private gardens, parking, and 24/7 security. Perfect for families seeking spacious homes in a gated community. Each villa comes with a private lawn, servant quarter, and modern security systems.',
                'price' => 24500000,
                'carpet_area' => 2500,
                'built_up_area' => 2800,
                'plot_area' => 3500,
                'address' => 'Sector 23, Dwarka',
                'is_featured' => true,
                'is_verified' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1600585154526-990dced4db0d?w=800',
                    'https://images.unsplash.com/photo-1600585154363-67eb9e2e2099?w=800',
                    'https://images.unsplash.com/photo-1600585152915-d208bec867a1?w=800',
                    'https://images.unsplash.com/photo-1600585152220-90363fe7e115?w=800',
                ],
                'specifications' => [
                    ['label' => 'Bedrooms', 'value' => '4'],
                    ['label' => 'Bathrooms', 'value' => '5'],
                    ['label' => 'Balconies', 'value' => '2'],
                    ['label' => 'Parking', 'value' => '3 Open + 1 Covered'],
                    ['label' => 'Flooring', 'value' => 'Granite & Marble'],
                    ['label' => 'Facing', 'value' => 'West'],
                ],
                'faqs' => [
                    ['question' => 'Is there a clubhouse?', 'answer' => 'Yes, the community has a fully equipped clubhouse with gym, pool, and party hall.'],
                    ['question' => 'What about water supply?', 'answer' => '24/7 water supply with backup from borewell and municipal connection.'],
                ],
            ],
            [
                'title' => 'Crown City Towers',
                'description' => 'Modern 3 BHK apartments in Noida with smart home features, clubhouse, and excellent connectivity. Under construction project with possession in 2026. Features include video door phone, central air conditioning, and premium fixtures throughout.',
                'price' => 13500000,
                'carpet_area' => 1450,
                'built_up_area' => 1650,
                'address' => 'Sector 150, Noida',
                'is_featured' => true,
                'is_verified' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=800',
                    'https://images.unsplash.com/photo-1600607687644-aac4c3eac7f4?w=800',
                    'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?w=800',
                    'https://images.unsplash.com/photo-1600607688969-a5bfcd646154?w=800',
                ],
                'specifications' => [
                    ['label' => 'Bedrooms', 'value' => '3'],
                    ['label' => 'Bathrooms', 'value' => '3'],
                    ['label' => 'Balconies', 'value' => '2'],
                    ['label' => 'Parking', 'value' => '2 Covered'],
                    ['label' => 'Flooring', 'value' => 'Vitrified Tiles'],
                    ['label' => 'Facing', 'value' => 'North'],
                ],
                'faqs' => [
                    ['question' => 'What is the construction status?', 'answer' => 'Currently 60% complete, expected possession by December 2026.'],
                    ['question' => 'Is there a payment plan?', 'answer' => 'Yes, flexible payment plans available linked to construction milestones.'],
                ],
            ],
            [
                'title' => 'Paradise Homes',
                'description' => 'Luxury 4 BHK penthouses in South Delhi with private terrace, jacuzzi, and panoramic city views. Premium location with easy access to shopping and dining. Each penthouse features a private lift, home automation, and designer interiors.',
                'price' => 45000000,
                'carpet_area' => 3500,
                'built_up_area' => 4000,
                'address' => 'Hauz Khas, South Delhi',
                'is_featured' => true,
                'is_verified' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?w=800',
                    'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=800',
                    'https://images.unsplash.com/photo-1600573472550-8090b5e0745e?w=800',
                    'https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?w=800',
                ],
                'specifications' => [
                    ['label' => 'Bedrooms', 'value' => '4'],
                    ['label' => 'Bathrooms', 'value' => '5'],
                    ['label' => 'Balconies', 'value' => '3'],
                    ['label' => 'Parking', 'value' => '4 Covered'],
                    ['label' => 'Flooring', 'value' => 'Italian Marble'],
                    ['label' => 'Facing', 'value' => 'South-West'],
                ],
                'faqs' => [
                    ['question' => 'Does it have a private pool?', 'answer' => 'Yes, each penthouse has a private jacuzzi on the terrace.'],
                    ['question' => 'What about security?', 'answer' => '24/7 security with CCTV surveillance and biometric access.'],
                ],
            ],
            [
                'title' => 'Silver Oak Villas',
                'description' => 'Premium 5 BHK villas in Gurgaon with private pool, home theater, and landscaped gardens. Ultra-luxury living for discerning buyers. Features include smart home automation, wine cellar, and separate guest house.',
                'price' => 65000000,
                'carpet_area' => 4800,
                'built_up_area' => 5500,
                'plot_area' => 7000,
                'address' => 'Golf Course Road, Gurgaon',
                'is_featured' => true,
                'is_verified' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800',
                    'https://images.unsplash.com/photo-1600566753151-384129cf4e3e?w=800',
                    'https://images.unsplash.com/photo-1600585154084-4e5fe7c39198?w=800',
                    'https://images.unsplash.com/photo-1600585152220-90363fe7e115?w=800',
                ],
                'specifications' => [
                    ['label' => 'Bedrooms', 'value' => '5'],
                    ['label' => 'Bathrooms', 'value' => '6'],
                    ['label' => 'Balconies', 'value' => '4'],
                    ['label' => 'Parking', 'value' => '5 Covered'],
                    ['label' => 'Flooring', 'value' => 'Imported Marble'],
                    ['label' => 'Facing', 'value' => 'North-East'],
                ],
                'faqs' => [
                    ['question' => 'Is there a private pool?', 'answer' => 'Yes, each villa has a private swimming pool with deck area.'],
                    ['question' => 'What about staff accommodation?', 'answer' => 'Separate servant quarters with 2 rooms and attached bathroom.'],
                ],
            ],
            [
                'title' => 'Heritage Mansion',
                'description' => 'Restored heritage property converted into luxury 3 BHK apartments in South Delhi. Blend of classic architecture with modern amenities. Features high ceilings, vintage chandeliers, and contemporary interiors.',
                'price' => 28000000,
                'carpet_area' => 1950,
                'built_up_area' => 2200,
                'address' => 'Safdarjung Enclave, South Delhi',
                'is_featured' => true,
                'is_verified' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?w=800',
                    'https://images.unsplash.com/photo-1600607688969-a5bfcd646154?w=800',
                    'https://images.unsplash.com/photo-1600607688960-e095ff83135c?w=800',
                    'https://images.unsplash.com/photo-1600607687644-c7171b42498b?w=800',
                ],
                'specifications' => [
                    ['label' => 'Bedrooms', 'value' => '3'],
                    ['label' => 'Bathrooms', 'value' => '3'],
                    ['label' => 'Balconies', 'value' => '2'],
                    ['label' => 'Parking', 'value' => '2 Covered'],
                    ['label' => 'Flooring', 'value' => 'Wooden & Marble'],
                    ['label' => 'Facing', 'value' => 'East'],
                ],
                'faqs' => [
                    ['question' => 'Is this a heritage property?', 'answer' => 'Yes, restored heritage building with modern amenities while preserving original architecture.'],
                    ['question' => 'Are renovations allowed?', 'answer' => 'Interior modifications allowed with society approval, exterior changes restricted.'],
                ],
            ],
        ];

        foreach ($properties as $index => $propertyData) {
            $this->command->info("Creating property: {$propertyData['title']}");
            
            $slug = Str::slug($propertyData['title']);
            
            // Create property
            $property = Property::create([
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
                'location_id' => !empty($locations) ? $locations[array_rand($locations)] : null,
                'property_type_id' => $propertyTypes[array_rand($propertyTypes)],
                'bhk_id' => $bhks[array_rand($bhks)],
                'builder_id' => !empty($builders) ? $builders[array_rand($builders)] : null,
                'project_status_id' => !empty($projectStatuses) ? $projectStatuses[array_rand($projectStatuses)] : null,
                'user_id' => $userId,
                'is_active' => true,
                'is_featured' => $propertyData['is_featured'],
                'is_verified' => $propertyData['is_verified'],
                'published_at' => now()->subDays(rand(1, 30)),
                'views_count' => rand(50, 500),
            ]);

            // Add images
            if (isset($propertyData['images'])) {
                foreach ($propertyData['images'] as $imageIndex => $imageUrl) {
                    PropertyImage::create([
                        'property_id' => $property->id,
                        'image_path' => $imageUrl,
                        'image_type' => $imageIndex === 0 ? 'main' : 'gallery',
                        'title' => $propertyData['title'] . ' - Image ' . ($imageIndex + 1),
                        'display_order' => $imageIndex + 1,
                    ]);
                }
            }

            // Add specifications
            if (isset($propertyData['specifications'])) {
                $specs = $propertyData['specifications'];
                $specData = [
                    'property_id' => $property->id,
                ];
                
                foreach ($specs as $spec) {
                    switch ($spec['label']) {
                        case 'Bedrooms':
                            $specData['bedrooms'] = $spec['value'];
                            break;
                        case 'Bathrooms':
                            $specData['bathrooms'] = $spec['value'];
                            break;
                        case 'Balconies':
                            $specData['balconies'] = $spec['value'];
                            break;
                        case 'Parking':
                            // Extract number from parking string
                            preg_match('/\d+/', $spec['value'], $matches);
                            $specData['parking_spaces'] = $matches[0] ?? 1;
                            break;
                        case 'Flooring':
                            // Store in furnishing_status for now
                            break;
                        case 'Facing':
                            $facing = strtolower(str_replace(['-', ' '], '_', $spec['value']));
                            $specData['facing'] = $facing;
                            break;
                    }
                }
                
                PropertySpecification::create($specData);
            }

            // Add FAQs
            if (isset($propertyData['faqs'])) {
                foreach ($propertyData['faqs'] as $faqIndex => $faq) {
                    PropertyFaq::create([
                        'property_id' => $property->id,
                        'question' => $faq['question'],
                        'answer' => $faq['answer'],
                        'is_active' => true,
                        'display_order' => $faqIndex + 1,
                    ]);
                }
            }

            // Attach random amenities (3-6 amenities per property)
            if (!empty($amenities)) {
                $randomAmenities = array_rand(array_flip($amenities), min(rand(3, 6), count($amenities)));
                $property->amenities()->attach($randomAmenities);
            }

            $this->command->info("✓ Property '{$propertyData['title']}' created with images, specs, and FAQs");
        }

        $this->command->info('✓ All properties seeded successfully with complete details!');
    }
}
