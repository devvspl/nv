<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'What facilities are available at the property?',
                'answer' => 'Our properties typically include high-speed Wi-Fi, modern kitchen appliances, and access to community amenities. Each property listing includes detailed information about specific facilities available.',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'question' => 'Is breakfast included in the room rate?',
                'answer' => 'This depends on the specific property listing. Please check the "Amenities" section on the property details page for more information about what is included in the rate.',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'question' => 'Do you provide airport transfer services?',
                'answer' => 'We do not directly provide transfer services, but we can recommend trusted local partners for your convenience. Please contact our support team after booking for assistance.',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'question' => 'Is the hotel family-friendly?',
                'answer' => 'Many of our properties are family-friendly. You can use the "Family-Friendly" filter in your search to find suitable options for your stay with children.',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'question' => 'What is your cancellation policy?',
                'answer' => 'Cancellation policies vary by property and booking type. Most properties offer free cancellation up to 24-48 hours before check-in. Please review the specific cancellation terms during booking.',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'question' => 'How do I make a property inquiry?',
                'answer' => 'You can make inquiries through our website contact form, call our customer service team, or use the inquiry button on any property listing page. We typically respond within 24 hours.',
                'is_active' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($faqs as $faq) {
            \App\Models\Faq::create($faq);
        }
    }
}
