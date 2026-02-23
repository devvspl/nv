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
        // Download and store images
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

        $sections = [
            [
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

        foreach ($sections as $section) {
            PropertyPageSection::updateOrCreate(
                ['section_key' => $section['section_key']],
                $section
            );
        }

        $this->command->info('Property page sections seeded successfully with images!');
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
