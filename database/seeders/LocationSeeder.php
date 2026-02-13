<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $locations = [
            ['name' => 'Mumbai', 'slug' => 'mumbai', 'description' => 'Financial capital of India', 'icon' => '', 'status' => true, 'sort_order' => 1],
            ['name' => 'Delhi', 'slug' => 'delhi', 'description' => 'Capital city of India', 'icon' => '', 'status' => true, 'sort_order' => 2],
            ['name' => 'Bengaluru', 'slug' => 'bengaluru', 'description' => 'Silicon Valley of India', 'icon' => '', 'status' => true, 'sort_order' => 3],
            ['name' => 'Hyderabad', 'slug' => 'hyderabad', 'description' => 'City of Pearls & IT Hub', 'icon' => '', 'status' => true, 'sort_order' => 4],
            ['name' => 'Chennai', 'slug' => 'chennai', 'description' => 'Cultural capital of South India', 'icon' => '', 'status' => true, 'sort_order' => 5],
            ['name' => 'Kolkata', 'slug' => 'kolkata', 'description' => 'Cultural capital of India', 'icon' => '', 'status' => true, 'sort_order' => 6],
            ['name' => 'Pune', 'slug' => 'pune', 'description' => 'Educational and IT hub of Maharashtra', 'icon' => '', 'status' => true, 'sort_order' => 7],
            ['name' => 'Ahmedabad', 'slug' => 'ahmedabad', 'description' => 'Commercial hub of Gujarat', 'icon' => '', 'status' => true, 'sort_order' => 8],
            ['name' => 'Jaipur', 'slug' => 'jaipur', 'description' => 'The Pink City of India', 'icon' => '', 'status' => true, 'sort_order' => 9],
            ['name' => 'Surat', 'slug' => 'surat', 'description' => 'Diamond and textile city', 'icon' => '', 'status' => true, 'sort_order' => 10],
            ['name' => 'Lucknow', 'slug' => 'lucknow', 'description' => 'City of Nawabs', 'icon' => '', 'status' => true, 'sort_order' => 11],
            ['name' => 'Kanpur', 'slug' => 'kanpur', 'description' => 'Industrial city of Uttar Pradesh', 'icon' => '', 'status' => true, 'sort_order' => 12],
            ['name' => 'Nagpur', 'slug' => 'nagpur', 'description' => 'Orange City of India', 'icon' => '', 'status' => true, 'sort_order' => 13],
            ['name' => 'Indore', 'slug' => 'indore', 'description' => 'Cleanest city of India', 'icon' => '', 'status' => true, 'sort_order' => 14],
            ['name' => 'Bhopal', 'slug' => 'bhopal', 'description' => 'City of Lakes', 'icon' => '', 'status' => true, 'sort_order' => 15],
            ['name' => 'Chandigarh', 'slug' => 'chandigarh', 'description' => 'Planned city of India', 'icon' => '', 'status' => true, 'sort_order' => 16],
            ['name' => 'Patna', 'slug' => 'patna', 'description' => 'Capital of Bihar with rich history', 'icon' => '', 'status' => true, 'sort_order' => 17],
            ['name' => 'Coimbatore', 'slug' => 'coimbatore', 'description' => 'Manchester of South India', 'icon' => '', 'status' => true, 'sort_order' => 18],
            ['name' => 'Kochi', 'slug' => 'kochi', 'description' => 'Major port city in Kerala', 'icon' => '', 'status' => true, 'sort_order' => 19],
            ['name' => 'Visakhapatnam', 'slug' => 'visakhapatnam', 'description' => 'Port city on east coast', 'icon' => '', 'status' => true, 'sort_order' => 20],
            ['name' => 'Varanasi', 'slug' => 'varanasi', 'description' => 'Spiritual capital of India', 'icon' => '', 'status' => true, 'sort_order' => 21],
            ['name' => 'Amritsar', 'slug' => 'amritsar', 'description' => 'Home of the Golden Temple', 'icon' => '', 'status' => true, 'sort_order' => 22],
            ['name' => 'Guwahati', 'slug' => 'guwahati', 'description' => 'Gateway to North East India', 'icon' => '', 'status' => true, 'sort_order' => 23],
            ['name' => 'Noida', 'slug' => 'noida', 'description' => 'IT and corporate hub in NCR', 'icon' => '', 'status' => true, 'sort_order' => 24],
            ['name' => 'Gurugram', 'slug' => 'gurugram', 'description' => 'Corporate and tech hub near Delhi', 'icon' => '', 'status' => true, 'sort_order' => 25],
        ];

        foreach ($locations as $location) {
            Location::create($location);
        }
    }
}
