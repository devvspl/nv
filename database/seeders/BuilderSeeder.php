<?php

namespace Database\Seeders;

use App\Models\Builder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BuilderSeeder extends Seeder
{
    public function run(): void
    {
        $builders = [
            [
                'name' => 'DLF Limited',
                'description' => 'Leading real estate developer in India',
                'website' => 'https://www.dlf.in',
                'email' => 'info@dlf.in',
                'phone' => '+91-124-4567890',
                'established_year' => 1946,
                'is_verified' => true,
                'status' => true,
                'display_order' => 1,
            ],
            [
                'name' => 'Godrej Properties',
                'description' => 'Trusted name in real estate development',
                'website' => 'https://www.godrejproperties.com',
                'email' => 'info@godrejproperties.com',
                'phone' => '+91-22-2518-8070',
                'established_year' => 1990,
                'is_verified' => true,
                'status' => true,
                'display_order' => 2,
            ],
            [
                'name' => 'Prestige Group',
                'description' => 'Premium residential and commercial projects',
                'website' => 'https://www.prestigeconstructions.com',
                'email' => 'info@prestigeconstructions.com',
                'phone' => '+91-80-2538-4000',
                'established_year' => 1986,
                'is_verified' => true,
                'status' => true,
                'display_order' => 3,
            ],
            [
                'name' => 'Sobha Limited',
                'description' => 'Quality construction and timely delivery',
                'website' => 'https://www.sobha.com',
                'email' => 'info@sobha.com',
                'phone' => '+91-80-4933-4000',
                'established_year' => 1995,
                'is_verified' => true,
                'status' => true,
                'display_order' => 4,
            ],
            [
                'name' => 'Brigade Group',
                'description' => 'Innovative and sustainable developments',
                'website' => 'https://www.brigadegroup.com',
                'email' => 'info@brigadegroup.com',
                'phone' => '+91-80-4137-0000',
                'established_year' => 1986,
                'is_verified' => true,
                'status' => true,
                'display_order' => 5,
            ],
        ];

        foreach ($builders as $builder) {
            Builder::create([
                ...$builder,
                'slug' => Str::slug($builder['name']),
            ]);
        }
    }
}
