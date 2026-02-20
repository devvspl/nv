<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProjectStatus;

class ProjectStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            [
                'name' => 'Ready to Move',
                'value' => 'ready',
                'description' => 'Properties that are completed and ready for immediate occupancy',
                'status' => true,
                'sort_order' => 1,
                'tag_color' => '#28a745', // green
            ],
            [
                'name' => 'Under Construction',
                'value' => 'under-construction',
                'description' => 'Properties currently under development',
                'status' => true,
                'sort_order' => 2,
                'tag_color' => '#ff9800', // orange
            ],
            [
                'name' => 'New Launch',
                'value' => 'new-launch',
                'description' => 'Newly launched projects available for booking',
                'status' => true,
                'sort_order' => 3,
                'tag_color' => '#007bff', // blue
            ],
        ];

        foreach ($statuses as $status) {
            ProjectStatus::create($status);
        }
    }
}
