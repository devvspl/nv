<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Inquiry;

class InquirySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inquiries = [
            [
                'name' => 'Amit Kumar',
                'phone' => '+91 98765 43210',
                'email' => 'amit.kumar@example.com',
                'property_type' => 'apartment',
                'message' => 'I am interested in a 3 BHK apartment in Noida. My budget is around 80-90 lakhs. Please share available options.',
                'status' => 'pending',
                'created_at' => now()->subHours(2),
            ],
            [
                'name' => 'Priya Sharma',
                'phone' => '+91 87654 32109',
                'email' => 'priya.sharma@example.com',
                'property_type' => 'commercial',
                'message' => 'Looking for commercial office space in Gurgaon for my startup. Need around 2000 sq ft with modern amenities.',
                'status' => 'responded',
                'created_at' => now()->subHours(5),
            ],
            [
                'name' => 'Rahul Verma',
                'phone' => '+91 76543 21098',
                'email' => 'rahul.verma@example.com',
                'property_type' => 'villa',
                'message' => 'Interested in a luxury villa in Gurgaon sector 45. Budget is flexible. Looking for 4-5 BHK with garden.',
                'status' => 'in_progress',
                'created_at' => now()->subDay(),
            ],
            [
                'name' => 'Sneha Patel',
                'phone' => '+91 65432 10987',
                'email' => 'sneha.patel@example.com',
                'property_type' => 'apartment',
                'message' => 'Need a 2 BHK apartment in Delhi for investment purpose. Good rental yield area preferred.',
                'status' => 'pending',
                'created_at' => now()->subHours(8),
            ],
            [
                'name' => 'Vikash Singh',
                'phone' => '+91 54321 09876',
                'email' => 'vikash.singh@example.com',
                'property_type' => 'commercial',
                'message' => 'Looking for retail space in prime location of Noida. Around 1500 sq ft for electronics showroom.',
                'status' => 'closed',
                'created_at' => now()->subDays(3),
            ],
            [
                'name' => 'Anita Gupta',
                'phone' => '+91 43210 98765',
                'email' => 'anita.gupta@example.com',
                'property_type' => 'villa',
                'message' => 'Searching for independent house/villa in Greater Noida. Budget 1.5-2 crores. Must have parking for 3 cars.',
                'status' => 'responded',
                'created_at' => now()->subHours(12),
            ],
            [
                'name' => 'Rajesh Agarwal',
                'phone' => '+91 32109 87654',
                'email' => 'rajesh.agarwal@example.com',
                'property_type' => 'apartment',
                'message' => 'Want to buy 3 BHK flat in Gurgaon near metro station. Budget up to 1.2 crores.',
                'status' => 'in_progress',
                'created_at' => now()->subHours(18),
            ],
            [
                'name' => 'Meera Joshi',
                'phone' => '+91 21098 76543',
                'email' => 'meera.joshi@example.com',
                'property_type' => 'office',
                'message' => 'Need office space for IT company in Cyber City Gurgaon. Around 5000 sq ft with modern infrastructure.',
                'status' => 'pending',
                'created_at' => now()->subMinutes(30),
            ],
        ];

        foreach ($inquiries as $inquiry) {
            Inquiry::create($inquiry);
        }
    }
}