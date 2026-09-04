<?php

namespace Database\Seeders;

use App\Models\PricingPlan;
use Illuminate\Database\Seeder;

class PricingPlanSeeder extends Seeder
{
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Starter Plan',
                'tagline' => 'MVP Launch',
                'price_range' => '$2,000 – $7,500',
                'timeline' => '3 – 8 weeks',
                'best_for' => 'Startups & founders validating an idea',
                'featured' => false,
                'sort_order' => 0,
                'deliverables' => [
                    'Product discovery & strategy session',
                    'UX wireframes + UI design (8–12 screens)',
                    'Website design & development (4–10 pages)',
                    'Responsive design for all devices',
                    'CMS setup (Webflow, WordPress, or Shopify) or basic custom frontend',
                    'Basic SEO optimization',
                    'Contact forms & email integration',
                    '2 revision cycles',
                    'Deployment & launch support',
                    '30 days post-launch support',
                ],
            ],
            [
                'name' => 'Growth Plan',
                'tagline' => 'Full Product Build',
                'price_range' => '$7,000 – $20,000',
                'timeline' => '3 – 6 months',
                'best_for' => 'SaaS startups & growing businesses ready to scale',
                'featured' => true,
                'sort_order' => 1,
                'deliverables' => [
                    'Complete product strategy & user flows',
                    'Full UI/UX design system (50+ screens)',
                    'Website design & development (10–25 pages)',
                    'Full-stack development with custom backend',
                    'Database architecture & API design',
                    'User authentication & admin dashboard',
                    'Advanced CMS integration or custom development',
                    'Payment processing integration',
                    'Email automation & notifications',
                    'Analytics & conversion tracking',
                    '3 revision cycles',
                    'Performance optimization & SEO',
                    '60 days post-launch support & bug fixes',
                ],
            ],
            [
                'name' => 'Scale Plan',
                'tagline' => 'Enterprise Solution',
                'price_range' => 'Custom Pricing (starts at $25,000+)',
                'timeline' => '6 months – 12+ months',
                'best_for' => 'Established companies & complex enterprise systems',
                'featured' => false,
                'sort_order' => 2,
                'deliverables' => [
                    'Dedicated product & development team',
                    'Advanced product architecture & strategy',
                    'Enterprise-grade design system',
                    'Multi-tenant SaaS platform development',
                    'Complex database architecture',
                    'Advanced security & compliance features',
                    'AI/ML integrations & automation',
                    'Third-party integrations (CRM, ERP, analytics)',
                    'Custom admin & reporting dashboards',
                    'Load testing & performance optimization',
                    'Unlimited revisions during development',
                    'Priority communication & dedicated account manager',
                ],
            ],
        ];

        foreach ($plans as $plan) {
            PricingPlan::updateOrCreate(['name' => $plan['name']], $plan);
        }
    }
}
