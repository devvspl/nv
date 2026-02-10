<?php

namespace Database\Seeders;

use App\Models\ServiceType;
use Illuminate\Database\Seeder;

class ServiceTypeSeeder extends Seeder
{
    public function run(): void
    {
        $serviceTypes = [
            [
                'name' => 'Buy',
                'slug' => 'buy',
                'description' => 'Purchase properties for ownership',
                'icon' => '🏠',
                'status' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Lease',
                'slug' => 'lease',
                'description' => 'Long-term property leasing options',
                'icon' => '📝',
                'status' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Rental',
                'slug' => 'rental',
                'description' => 'Short-term and monthly rental properties',
                'icon' => '🔑',
                'status' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($serviceTypes as $serviceType) {
            ServiceType::create($serviceType);
        }
    }
}
