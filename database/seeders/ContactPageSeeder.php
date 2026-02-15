<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactPageSection;
use App\Models\ContactInfo;

class ContactPageSeeder extends Seeder
{
    public function run(): void
    {
        // Create Contact Page Sections
        ContactPageSection::create([
            'section_key' => 'banner',
            'heading' => 'Contact Us',
            'subheading' => null,
            'description' => null,
            'banner_image' => null,
            'is_active' => true,
        ]);

        ContactPageSection::create([
            'section_key' => 'contact_section',
            'heading' => "We'd Love to Hear From You — Reach Out!",
            'subheading' => 'Contact Us',
            'description' => null,
            'banner_image' => null,
            'is_active' => true,
        ]);

        ContactPageSection::create([
            'section_key' => 'inquiry_section',
            'heading' => 'Your Dream Property Awaits — Inquire Today',
            'subheading' => 'Get Inquiry',
            'description' => 'Step into a world of refined elegance and timeless comfort. Secure your dream property with our expert guidance – it\'s just an inquiry away.',
            'banner_image' => null,
            'is_active' => true,
        ]);

        // Create Contact Information Cards
        ContactInfo::create([
            'section_key' => 'office_address',
            'title' => 'Office Address',
            'content' => 'Registered Office: Room No 1, Plot No 1, Ground Floor, Vatika Primrose Avenue, Sector-82, Gurugram, Haryana - 122012',
            'icon' => null,
            'sort_order' => 1,
            'is_active' => true,
        ]);

        ContactInfo::create([
            'section_key' => 'contact_no',
            'title' => 'Contact No',
            'content' => '+91 99901 86086',
            'icon' => null,
            'sort_order' => 2,
            'is_active' => true,
        ]);

        ContactInfo::create([
            'section_key' => 'email',
            'title' => 'E-Mail',
            'content' => 'info@zendoindia.com',
            'icon' => null,
            'sort_order' => 3,
            'is_active' => true,
        ]);

        ContactInfo::create([
            'section_key' => 'working_hours',
            'title' => 'Working Hours',
            'content' => 'Monday to Saturday, 10:00 AM – 7:00 PM. Sunday closed.',
            'icon' => null,
            'sort_order' => 4,
            'is_active' => true,
        ]);

        $this->command->info('Contact page data seeded successfully!');
    }
}
