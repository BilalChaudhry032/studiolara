<?php

namespace Database\Seeders;

use App\Models\CaseStudy;
use Illuminate\Database\Seeder;

class CaseStudySeeder extends Seeder
{
    /**
     * Placeholder case studies - the SRS doc defines the required template
     * (About -> Challenges -> Problems/Solutions -> Outcome -> Testimonial)
     * but names no real projects. Replace with real client work in Filament
     * once available; these exist so /work and /work/{slug} are navigable
     * and demonstrate the full template structure.
     */
    public function run(): void
    {
        $studies = [
            [
                'title' => 'SaaS Platform Redesign',
                'client' => 'Sample Client',
                'category' => 'SaaS Product Development',
                'service_tags' => ['UI/UX Design', 'SaaS Product Development'],
                'tools' => ['Figma', 'React', 'Node.js'],
                'about' => 'A full redesign of a multi-tenant SaaS dashboard, focused on simplifying complex workflows for enterprise users while modernizing the visual system.',
                'challenges' => [
                    'Legacy dashboard had grown organically with no consistent design system',
                    'Power users needed dense data views without sacrificing clarity',
                    'Onboarding drop-off was high for new accounts',
                ],
                'problems_solutions' => [
                    ['problem' => 'Inconsistent UI patterns across 40+ screens', 'solution' => 'Built a unified design system with reusable components'],
                    ['problem' => 'New users abandoned setup before activation', 'solution' => 'Redesigned onboarding into a guided, progressive flow'],
                ],
                'outcome_results' => 'The redesigned platform shipped in phases over 4 months, with a new component library covering 50+ screens and a measurably smoother onboarding path.',
                'testimonial_quote' => null,
                'testimonial_author' => null,
                'testimonial_title' => null,
            ],
            [
                'title' => 'E-Commerce Relaunch',
                'client' => 'Sample Client',
                'category' => 'Web Development',
                'service_tags' => ['Web Development', 'CMS Development'],
                'tools' => ['Webflow', 'Figma'],
                'about' => 'A full storefront relaunch built for speed and conversion, migrating a legacy platform onto a modern, marketing-team-friendly CMS.',
                'challenges' => [
                    'Legacy platform was slow and difficult for the marketing team to update',
                    'Mobile conversion lagged well behind desktop',
                ],
                'problems_solutions' => [
                    ['problem' => 'Marketing team relied on developers for every content change', 'solution' => 'Migrated to a flexible CMS with reusable content blocks'],
                    ['problem' => 'Mobile checkout had a high abandonment rate', 'solution' => 'Redesigned the mobile checkout flow around fewer steps'],
                ],
                'outcome_results' => 'Launched a fully responsive storefront with a CMS the marketing team manages independently.',
                'testimonial_quote' => null,
                'testimonial_author' => null,
                'testimonial_title' => null,
            ],
            [
                'title' => 'Mobile Booking App',
                'client' => 'Sample Client',
                'category' => 'Mobile App Design & Dev',
                'service_tags' => ['Mobile App Design & Dev', 'UI/UX Design'],
                'tools' => ['Figma', 'React Native'],
                'about' => 'A cross-platform booking app designed to make a multi-step reservation process feel effortless on a small screen.',
                'challenges' => [
                    'Booking flow had too many steps for mobile users to complete comfortably',
                    'iOS and Android needed to ship from a single codebase on a tight timeline',
                ],
                'problems_solutions' => [
                    ['problem' => 'Multi-step booking form caused high drop-off', 'solution' => 'Condensed the flow into a single guided screen with smart defaults'],
                ],
                'outcome_results' => 'Shipped to both iOS and Android from one React Native codebase, with a streamlined booking flow.',
                'testimonial_quote' => null,
                'testimonial_author' => null,
                'testimonial_title' => null,
            ],
        ];

        foreach ($studies as $index => $study) {
            CaseStudy::updateOrCreate(
                ['slug' => str($study['title'])->slug()],
                $study + ['sort_order' => $index, 'published_at' => now()]
            );
        }
    }
}
