<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Anjali Arora',
                'position' => 'Marketing Manager',
                'company' => 'Tech Corp',
                'content' => 'I cannot express enough how grateful I am to ZENDO and their incredible team for helping me find my dream home. Their professionalism and dedication made the entire process seamless.',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Rohan Sharma',
                'position' => 'Business Owner',
                'company' => null,
                'content' => 'I recently sold my home with the help of ZENDO Real Estate Agency, and I must say, their team truly cares about their clients. The service was exceptional from start to finish.',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Priya Verma',
                'position' => 'Software Engineer',
                'company' => 'TechSoft Solutions',
                'content' => 'I had the pleasure of working with ZENDO to find my first home, and I am delighted with the experience. They understood my needs perfectly and found exactly what I was looking for.',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Vikram Kumar',
                'position' => 'Doctor',
                'company' => 'City Hospital',
                'content' => 'The team was professional, knowledgeable, and always available to answer my questions. Highly recommended! They made buying my new clinic space stress-free.',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Sneha Patel',
                'position' => 'Interior Designer',
                'company' => 'Design Studio',
                'content' => 'ZENDO helped me find the perfect office space for my design studio. Their attention to detail and understanding of my requirements was impressive.',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Amit Singh',
                'position' => 'Entrepreneur',
                'company' => 'StartUp Inc',
                'content' => 'Excellent service and great properties! The team at ZENDO went above and beyond to help me secure a commercial space for my startup. Truly professional.',
                'is_active' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
