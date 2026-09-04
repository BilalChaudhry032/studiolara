<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    /**
     * Placeholder roster - the SRS doc calls for team profiles but names no
     * real people. Replace with real names/roles/bios/photos in Filament
     * once provided (see PROJECT_PLAN_AND_PROGRESS.md).
     */
    public function run(): void
    {
        $roster = [
            ['role' => 'Creative Director', 'bio' => 'Leads brand and product design across every engagement.'],
            ['role' => 'Head of Engineering', 'bio' => 'Owns web and SaaS architecture from MVP to scale.'],
            ['role' => 'Lead Product Designer', 'bio' => 'Focused on UX strategy and high-fidelity prototyping.'],
            ['role' => 'Senior Frontend Engineer', 'bio' => 'Specializes in performance and accessibility.'],
            ['role' => 'Mobile Engineering Lead', 'bio' => 'Builds cross-platform iOS & Android experiences.'],
            ['role' => 'Client Partnerships Lead', 'bio' => 'Guides discovery and strategy for new engagements.'],
        ];

        foreach ($roster as $index => $member) {
            TeamMember::updateOrCreate(
                ['role' => $member['role']],
                [
                    'name' => 'Team Member',
                    'bio' => $member['bio'],
                    'sort_order' => $index,
                ]
            );
        }
    }
}
