<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $features = [
            [
                'title' => 'Budget Friendly',
                'description' => 'Properties are most budget friendly so you have opportunity to find the best one.',
                'icon' => 'Budget-Friendly.svg',
                'tag' => 'why-choose-us',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Prime Location',
                'description' => 'All our properties are located in prime areas with excellent connectivity and infrastructure.',
                'icon' => 'location.svg',
                'tag' => 'why-choose-us',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Trusted By Thousands',
                'description' => 'We have successfully helped thousands of clients find their dream properties with complete satisfaction.',
                'icon' => 'trusted.svg',
                'tag' => 'why-choose-us',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Wide Range Of Properties',
                'description' => 'From residential to commercial, we offer a diverse portfolio of properties to meet all your needs.',
                'icon' => 'Wide Range Of Properties.svg',
                'tag' => 'our-services',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'Financing Made Easy',
                'description' => 'We provide comprehensive financing solutions and guidance to make your property purchase seamless.',
                'icon' => 'Financing Made Easy.svg',
                'tag' => 'our-services',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'title' => 'Trusted By Thousands',
                'description' => 'We have successfully helped thousands of clients find their dream properties.',
                'icon' => 'Trusted By Thousands.svg',
                'tag' => 'our-services',
                'is_active' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($features as $feature) {
            \App\Models\Feature::create($feature);
        }
    }
}
