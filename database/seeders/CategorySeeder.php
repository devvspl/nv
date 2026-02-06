<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Living House',
                'slug' => 'living-house',
                'description' => 'Preview listing of accommodation property living houses and hotels',
                'icon' => 'living-house.svg',
                'link' => '/properties/living-house',
                'status' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Solid Land',
                'slug' => 'solid-land',
                'description' => 'High listed solid use-able land in most popular area for development',
                'icon' => 'soild-land.svg',
                'link' => '/properties/solid-land',
                'status' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Office Floor',
                'slug' => 'office-floor',
                'description' => 'Preview most popular area\'s office building available in listing for rent and sale',
                'icon' => 'office-floor.svg',
                'link' => '/properties/office-floor',
                'status' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Commercial',
                'slug' => 'commercial',
                'description' => 'Find the commercial property for business and factory development',
                'icon' => 'commercial.svg',
                'link' => '/properties/commercial',
                'status' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Hostel Room',
                'slug' => 'hostel-room',
                'description' => 'If you are single looking for single living, preview the hostel listing',
                'icon' => 'hostel-room.svg',
                'link' => '/properties/hostel-room',
                'status' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Apartment',
                'slug' => 'apartment',
                'description' => 'Family apartment, find your best apartment in our directory listing',
                'icon' => 'apartment.svg',
                'link' => '/properties/apartment',
                'status' => true,
                'sort_order' => 6,
            ],
            [
                'name' => 'Condo House',
                'slug' => 'condo-house',
                'description' => 'Condo house for family and single living, find your best condo house',
                'icon' => 'condo-house.svg',
                'link' => '/properties/condo-house',
                'status' => true,
                'sort_order' => 7,
            ],
            [
                'name' => 'Villa',
                'slug' => 'villa',
                'description' => 'Luxury villa for family living, find your best villa in our directory',
                'icon' => 'villa.svg',
                'link' => '/properties/villa',
                'status' => true,
                'sort_order' => 8,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
