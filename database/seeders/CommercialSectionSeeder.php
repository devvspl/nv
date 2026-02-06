<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CommercialSection;

class CommercialSectionSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        CommercialSection::create([
            'badge' => 'Commercial Expertise',
            'title' => 'Premium Commercial Properties — Strategic & Business-Ready Spaces',
            'subtitle' => 'We also work on commercial real estate solutions — from office spaces to retail and investment-ready assets. This section highlights our commercial domain in a clean, informative way (without listings).',
            'points' => [
                [
                    'title' => 'Offices & Corporate Spaces',
                    'description' => 'Modern office spaces designed for productivity and growth'
                ],
                [
                    'title' => 'Retail, Showrooms & High-Street',
                    'description' => 'Prime retail locations with high footfall and visibility'
                ],
                [
                    'title' => 'Warehousing & Industrial Units',
                    'description' => 'Strategic industrial spaces for logistics and manufacturing'
                ]
            ],
            'primary_button_text' => 'Request Commercial Consultation',
            'primary_button_link' => '#contact',
            'secondary_button_text' => 'View Our Work',
            'secondary_button_link' => '#projects',
            'gallery_images' => [
                [
                    'src' => 'main/images/commercial-1.png',
                    'alt' => 'Commercial property workspace interior',
                    'label' => 'Commercial project image 1'
                ],
                [
                    'src' => 'main/images/commercial-2.png',
                    'alt' => 'Retail showroom commercial space',
                    'label' => 'Commercial project image 2'
                ],
                [
                    'src' => 'main/images/commercial-3.png',
                    'alt' => 'Office building commercial exterior',
                    'label' => 'Commercial project image 3'
                ],
                [
                    'src' => 'main/images/delhi.jpg',
                    'alt' => 'Warehouse industrial commercial unit',
                    'label' => 'Commercial project image 4'
                ]
            ],
            'gallery_note' => 'Gallery Preview: Offices • Retail • Industrial • Investment Spaces',
            'is_active' => true
        ]);
    }
}