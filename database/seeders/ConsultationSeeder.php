<?php

namespace Database\Seeders;

use App\Models\Consultation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConsultationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $consultations = [
            [
                'name' => 'Rajesh Kumar',
                'phone' => '+91 9876543210',
                'email' => 'rajesh.kumar@example.com',
                'property_type' => 'apartment',
                'message' => 'I am looking for a 3BHK apartment in Noida with good connectivity to Delhi. My budget is around 80 lakhs. Please provide me with suitable options.',
                'status' => 'pending',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'name' => 'Priya Sharma',
                'phone' => '+91 8765432109',
                'email' => 'priya.sharma@example.com',
                'property_type' => 'villa',
                'message' => 'Looking for a luxury villa in Gurgaon with swimming pool and garden. Budget is flexible for the right property.',
                'status' => 'contacted',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subHours(6),
            ],
            [
                'name' => 'Amit Patel',
                'phone' => '+91 7654321098',
                'email' => 'amit.patel@example.com',
                'property_type' => 'commercial',
                'message' => 'Need office space for my IT company in Sector 62, Noida. Looking for 5000-8000 sq ft area.',
                'status' => 'in_progress',
                'created_at' => now()->subHours(12),
                'updated_at' => now()->subHours(2),
            ],
            [
                'name' => 'Sunita Gupta',
                'phone' => '+91 6543210987',
                'email' => 'sunita.gupta@example.com',
                'property_type' => 'apartment',
                'message' => 'First-time home buyer looking for 2BHK apartment in Greater Noida. Need guidance on home loan and documentation.',
                'status' => 'completed',
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(1),
            ],
            [
                'name' => 'Vikram Singh',
                'phone' => '+91 5432109876',
                'email' => 'vikram.singh@example.com',
                'property_type' => 'villa',
                'message' => 'Looking for investment property - villa or independent house in Delhi NCR. Budget 2-3 crores.',
                'status' => 'pending',
                'created_at' => now()->subHours(3),
                'updated_at' => now()->subHours(3),
            ],
        ];

        foreach ($consultations as $consultation) {
            Consultation::create($consultation);
        }
    }
}