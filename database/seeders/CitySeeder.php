<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            [
                'name' => 'Delhi',
                'slug' => 'delhi',
                'description' => 'India\'s capital city with rich history and modern infrastructure',
                'image' => 'main/images/city/delhi.jpg',
                'property_count' => 250,
                'link' => '/properties/delhi',
                'status' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Noida',
                'slug' => 'noida',
                'description' => 'Planned city in Uttar Pradesh, known for IT companies and modern living',
                'image' => 'main/images/city/noida.jpg',
                'property_count' => 180,
                'link' => '/properties/noida',
                'status' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Gurgaon',
                'slug' => 'gurgaon',
                'description' => 'Financial and technology hub in Haryana with premium residential options',
                'image' => 'main/images/city/gurgaon.jpeg',
                'property_count' => 320,
                'link' => '/properties/gurgaon',
                'status' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Greater Noida',
                'slug' => 'greater-noida',
                'description' => 'Emerging city with excellent connectivity and affordable housing options',
                'image' => 'main/images/city/greater-noida.jpg',
                'property_count' => 150,
                'link' => '/properties/greater-noida',
                'status' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}