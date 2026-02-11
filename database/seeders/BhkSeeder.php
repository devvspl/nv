<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bhk;

class BhkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bhks = [
            [
                'name' => '1 BHK',
                'value' => '1',
                'description' => 'One bedroom, hall, and kitchen',
                'status' => true,
                'sort_order' => 1,
            ],
            [
                'name' => '2 BHK',
                'value' => '2',
                'description' => 'Two bedrooms, hall, and kitchen',
                'status' => true,
                'sort_order' => 2,
            ],
            [
                'name' => '3 BHK',
                'value' => '3',
                'description' => 'Three bedrooms, hall, and kitchen',
                'status' => true,
                'sort_order' => 3,
            ],
            [
                'name' => '4+ BHK',
                'value' => '4+',
                'description' => 'Four or more bedrooms, hall, and kitchen',
                'status' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($bhks as $bhk) {
            Bhk::create($bhk);
        }
    }
}
