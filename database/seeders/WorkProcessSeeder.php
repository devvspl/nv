<?php

namespace Database\Seeders;

use App\Models\WorkProcess;
use Illuminate\Database\Seeder;

class WorkProcessSeeder extends Seeder
{
    public function run(): void
    {
        $workProcesses = [
            [
                'title' => 'Initial Consultation',
                'description' => 'We start by understanding your exact requirements, budget, and long-term goals.',
                'step_number' => 1,
                'display_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Search & Vetting',
                'description' => 'Our team curates a shortlist of verified properties that precisely match your criteria.',
                'step_number' => 2,
                'display_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Viewings & Negotiation',
                'description' => 'We arrange viewings and handle all negotiations to secure the best possible deal for you.',
                'step_number' => 3,
                'display_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Final Closing & Handover',
                'description' => 'Seamless execution of legal documentation and final property handover with full support.',
                'step_number' => 4,
                'display_order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($workProcesses as $process) {
            WorkProcess::create($process);
        }
    }
}
