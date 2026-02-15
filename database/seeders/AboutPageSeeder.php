<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AboutPageSection;
use App\Models\OurClient;
use App\Models\TeamMember;

class AboutPageSeeder extends Seeder
{
    public function run(): void
    {
        // Create About Page Section (single record with all content)
        AboutPageSection::create([
            'section_title' => 'About Us',
            'section_subtitle' => 'Building Trust, Delivering Excellence',
            
            // Our Company Section
            'who_we_are_title' => 'Who We Are',
            'who_we_are_description' => 'ZendoIndia is a premier real estate consultancy dedicated to helping you find your dream property. With years of experience in the industry, we provide expert guidance and personalized service to make your property journey seamless.',
            'who_we_are_icon' => null,
            
            'mission_title' => 'Our Mission',
            'mission_description' => 'To revolutionize the real estate experience by providing transparent, efficient, and customer-centric services that empower our clients to make informed property decisions.',
            'mission_icon' => null,
            
            'vision_title' => 'Our Vision',
            'vision_description' => 'To be the most trusted and innovative real estate platform in India, setting new standards in property consultation and customer satisfaction.',
            'vision_icon' => null,
            
            // Our Values Section
            'values_heading' => 'Our Core Values',
            'values_who_we_are' => 'We believe in complete transparency and honesty in all our dealings. Our clients trust us because we always put their interests first and provide accurate, unbiased information.',
            'values_mission' => 'We strive for excellence in every aspect of our service. From property selection to documentation, we ensure the highest quality standards are maintained throughout your journey.',
            'values_vision' => 'We leverage cutting-edge technology and innovative solutions to make property search and transactions easier, faster, and more efficient for our clients.',
            'values_teamwork' => 'Our clients are at the heart of everything we do. We listen to your needs, understand your preferences, and work tirelessly to exceed your expectations.',
            
            // Team Section
            'team_section_title' => 'Our Team',
            'team_section_heading' => 'Meet Our Expert Team',
            
            'is_active' => true,
        ]);

        // Create Sample Clients
        OurClient::create([
            'name' => 'DLF Limited',
            'logo' => 'clients/dlf.png',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        OurClient::create([
            'name' => 'Godrej Properties',
            'logo' => 'clients/godrej.png',
            'sort_order' => 2,
            'is_active' => true,
        ]);

        OurClient::create([
            'name' => 'Prestige Group',
            'logo' => 'clients/prestige.png',
            'sort_order' => 3,
            'is_active' => true,
        ]);

        OurClient::create([
            'name' => 'Sobha Limited',
            'logo' => 'clients/sobha.png',
            'sort_order' => 4,
            'is_active' => true,
        ]);

        OurClient::create([
            'name' => 'Brigade Group',
            'logo' => 'clients/brigade.png',
            'sort_order' => 5,
            'is_active' => true,
        ]);

        OurClient::create([
            'name' => 'Lodha Group',
            'logo' => 'clients/lodha.png',
            'sort_order' => 6,
            'is_active' => true,
        ]);

        // Create Sample Team Members
        TeamMember::create([
            'name' => 'Rajesh Kumar',
            'position' => 'Founder & CEO',
            'photo' => 'team/rajesh.jpg',
            'linkedin_url' => 'https://linkedin.com',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        TeamMember::create([
            'name' => 'Priya Sharma',
            'position' => 'Head of Sales',
            'photo' => 'team/priya.jpg',
            'linkedin_url' => 'https://linkedin.com',
            'sort_order' => 2,
            'is_active' => true,
        ]);

        TeamMember::create([
            'name' => 'Amit Patel',
            'position' => 'Senior Property Consultant',
            'photo' => 'team/amit.jpg',
            'linkedin_url' => 'https://linkedin.com',
            'sort_order' => 3,
            'is_active' => true,
        ]);

        TeamMember::create([
            'name' => 'Sneha Reddy',
            'position' => 'Marketing Manager',
            'photo' => 'team/sneha.jpg',
            'linkedin_url' => 'https://linkedin.com',
            'sort_order' => 4,
            'is_active' => true,
        ]);

        $this->command->info('About page data seeded successfully!');
    }
}
