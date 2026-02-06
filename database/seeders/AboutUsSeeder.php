<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AboutUs;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        AboutUs::create([
            'title' => 'Our mission is to redefine real estate for our customers',
            'subtitle' => 'ZENDO is one of the world\'s leading property agents. Our experience spans the globe.',
            'description' => 'ZENDO is one of the world\'s leading property agents. Our experience spans the globe.',
            'mission_text' => 'where we believe in more than just selling properties – we envision a future where every individual\'s dreams of owning a home, securing an investment, or finding the perfect commercial space come true. Our mission is not just a statement, but a driving force that guides every decision and action we take. Since our inception, we have been committed to empowering people and building a brighter future through real estate excellence.',
            'checklist_items' => [
                'Verified property listings',
                'Transparent, upfront pricing',
                'Unlimited access to listings',
                'Dedicated 24/7 support',
                'In-depth market analytics'
            ],
            'stats' => [
                [
                    'value' => '15.4',
                    'label' => 'Amount Transactions (In Rupees)',
                    'prefix' => '',
                    'suffix' => 'M'
                ],
                [
                    'value' => '25',
                    'label' => 'Properties Sold',
                    'prefix' => '',
                    'suffix' => 'K+'
                ],
                [
                    'value' => '1500',
                    'label' => 'Positive Feedback',
                    'prefix' => '',
                    'suffix' => '+'
                ]
            ],
            'status' => true,
            'sort_order' => 0,
        ]);
    }
}