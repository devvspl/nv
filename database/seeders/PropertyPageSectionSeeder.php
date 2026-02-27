<?php

namespace Database\Seeders;

use App\Models\PropertyPageSection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class PropertyPageSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get property types
        $residentialType = \App\Models\PropertyType::where('category', 'residential')->first();
        $commercialType = \App\Models\PropertyType::where('category', 'commercial')->first();

        if (!$residentialType) {
            $this->command->warn('No residential property type found. Please create property types first.');
            return;
        }

        // Download and store images for residential
        $carouselImages = $this->downloadImages([
            'https://images.unsplash.com/photo-1501183638710-841dd1904471?auto=format&fit=crop&w=1400&q=80',
            'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?auto=format&fit=crop&w=1400&q=80',
            'https://images.unsplash.com/photo-1502005229762-cf1b2da7c5d6?auto=format&fit=crop&w=1400&q=80',
            'https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=1400&q=80',
        ], 'carousel');

        $perspectiveImages = $this->downloadImages([
            'https://images.unsplash.com/photo-1502005229762-cf1b2da7c5d6?auto=format&fit=crop&w=1200&q=70',
            'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=1200&q=70',
            'https://images.unsplash.com/photo-1449844908441-8829872d2607?auto=format&fit=crop&w=1200&q=70',
            'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=1200&q=70',
        ], 'perspective');

        // Residential sections
        $residentialSections = [
            [
                'property_type_id' => $residentialType->id,
                'section_key' => 'intro_section',
                'kicker' => 'Residential Properties',
                'title' => 'Find Your Premium Home in Top Locations',
                'description' => 'Explore handpicked apartments, builder floors, villas, and plots across prime residential areas. Use the filters to shortlist the right home faster.',
                'badges' => ['Verified Listings', 'Fast Shortlisting', 'Prime Locations'],
                'is_active' => true,
                'order' => 0,
            ],
            [
                'property_type_id' => $residentialType->id,
                'section_key' => 'carousel_section',
                'title' => 'Homes Designed for Comfort, Space & Lifestyle',
                'subtitle' => 'Residential Living',
                'description' => 'Every residence listed above is selected with a clear focus on location, design quality, and everyday livability. Whether you are looking for a modern apartment or a spacious independent home, the right options are curated to match different lifestyle needs.',
                'button_text' => 'Get Expert Advice',
                'button_link' => '#enquiry',
                'secondary_button_text' => 'View More Projects',
                'secondary_button_link' => '#projects',
                'images' => $carouselImages,
                'features' => [],
                'is_active' => true,
                'order' => 1,
            ],
            [
                'property_type_id' => $residentialType->id,
                'section_key' => 'perspective_section',
                'title' => 'Choose the Right Home with Clear, Practical Insights',
                'subtitle' => 'Residential Properties',
                'description' => 'Explore residential projects with a simple view of location, connectivity, amenities, safety, and long-term comfort. Use these quick pointers to compare options faster and shortlist the best fit for your family.',
                'button_text' => 'Get Project List',
                'button_link' => '#enquiry',
                'secondary_button_text' => 'Request a Call',
                'secondary_button_link' => '#contact',
                'images' => $perspectiveImages,
                'features' => [
                    '<strong>Connectivity:</strong> Main roads, expressways, office hubs & public transport access.',
                    '<strong>Project Amenities:</strong> Clubhouse, gym, kids play, green spaces, parking & power backup.',
                    '<strong>Floor Plan Fit:</strong> Layout flow, ventilation, balcony use, storage & usable carpet area.',
                ],
                'is_active' => true,
                'order' => 2,
            ],
        ];

        foreach ($residentialSections as $section) {
            PropertyPageSection::updateOrCreate(
                [
                    'property_type_id' => $section['property_type_id'],
                    'section_key' => $section['section_key']
                ],
                $section
            );
        }

        $this->command->info('Residential property page sections seeded successfully!');

        // Commercial sections (if commercial type exists)
        if ($commercialType) {
            $commercialSections = [
                [
                    'property_type_id' => $commercialType->id,
                    'section_key' => 'intro_section',
                    'kicker' => 'Commercial Properties',
                    'title' => 'Premium Commercial Spaces for Your Business',
                    'description' => 'Discover office spaces, retail shops, warehouses, and commercial plots in strategic business locations. Find the perfect space to grow your business.',
                    'badges' => ['Prime Locations', 'High ROI', 'Ready to Move'],
                    'is_active' => true,
                    'order' => 0,
                ],
                [
                    'property_type_id' => $commercialType->id,
                    'section_key' => 'carousel_section',
                    'title' => 'Strategic Commercial Spaces for Business Growth',
                    'subtitle' => 'Commercial Properties',
                    'description' => 'Every commercial property is selected based on location advantage, connectivity, and business potential. Whether you need office space, retail outlet, or warehouse, find options that match your business requirements.',
                    'button_text' => 'Schedule Site Visit',
                    'button_link' => '#enquiry',
                    'secondary_button_text' => 'View All Properties',
                    'secondary_button_link' => '#projects',
                    'images' => $carouselImages,
                    'features' => [],
                    'is_active' => true,
                    'order' => 1,
                ],
                [
                    'property_type_id' => $commercialType->id,
                    'section_key' => 'perspective_section',
                    'title' => 'Make Informed Commercial Property Decisions',
                    'subtitle' => 'Commercial Properties',
                    'description' => 'Evaluate commercial properties with key business metrics. Compare locations, accessibility, infrastructure, and investment potential to choose the right space for your business.',
                    'button_text' => 'Get Investment Guide',
                    'button_link' => '#enquiry',
                    'secondary_button_text' => 'Talk to Expert',
                    'secondary_button_link' => '#contact',
                    'images' => $perspectiveImages,
                    'features' => [
                        '<strong>Location Advantage:</strong> Business districts, main roads, metro connectivity & parking.',
                        '<strong>Infrastructure:</strong> Power backup, elevators, security systems & modern amenities.',
                        '<strong>Investment Potential:</strong> Rental yield, appreciation rate & business footfall.',
                    ],
                    'is_active' => true,
                    'order' => 2,
                ],
            ];

            foreach ($commercialSections as $section) {
                PropertyPageSection::updateOrCreate(
                    [
                        'property_type_id' => $section['property_type_id'],
                        'section_key' => $section['section_key']
                    ],
                    $section
                );
            }

            $this->command->info('Commercial property page sections seeded successfully!');
        }

        $this->command->info('All property page sections seeded successfully with images!');
    }

    /**
     * Download images from URLs and store them
     */
    private function downloadImages(array $urls, string $prefix): array
    {
        $storedPaths = [];

        foreach ($urls as $index => $url) {
            try {
                $response = Http::timeout(30)->get($url);
                
                if ($response->successful()) {
                    $filename = $prefix . '_' . ($index + 1) . '_' . time() . '.jpg';
                    $path = 'property-page-sections/' . $filename;
                    
                    Storage::disk('public')->put($path, $response->body());
                    $storedPaths[] = $path;
                    
                    $this->command->info("Downloaded: {$filename}");
                } else {
                    $this->command->warn("Failed to download image from: {$url}");
                }
            } catch (\Exception $e) {
                $this->command->error("Error downloading {$url}: " . $e->getMessage());
            }
        }

        return $storedPaths;
    }
}
