<?php

namespace Database\Seeders;

use App\Models\HeroSection;
use Illuminate\Database\Seeder;

class HeroSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HeroSection::create([
            'title' => 'Find Your Perfect',
            'highlight_text' => 'Property',
            'description' => 'Discover the best properties to buy, lease, or invest in across India. Your new beginning starts here with ZENDO.',
            'video_path' => null, // You can upload a video from admin panel
            'poster_image' => null, // You can upload a poster from admin panel
            'status' => true,
            'sort_order' => 0,
        ]);
    }
}
