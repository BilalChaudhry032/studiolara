<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title' => 'UI/UX Design',
                'description' => 'We design intuitive, conversion-focused digital experiences that connect brand, strategy, and usability. Deliverables include user research, journey mapping, wireframes, prototypes, design systems, and polished UI for SaaS dashboards, marketing sites, and mobile products.',
                'tools_technologies' => ['Figma', 'FigJam', 'Adobe XD', 'Design systems', 'Accessibility best practices', 'Usability testing'],
                'best_for' => 'Startups, product teams, and companies redesigning complex experiences or launching new digital products.',
                'use_cases' => ['SaaS onboarding', 'Dashboard redesigns', 'Mobile app flows', 'Product validation', 'High-converting landing pages'],
                'icon' => 'o-paint-brush',
            ],
            [
                'title' => 'Web Development',
                'description' => 'We build fast, scalable websites and web applications with clean architecture and performance in mind. From interactive marketing websites to robust platforms, we develop responsive experiences that are SEO-ready, maintainable, and built to support growth.',
                'tools_technologies' => ['React', 'Next.js', 'TypeScript', 'Modern CMS integrations', 'APIs', 'Technical SEO'],
                'best_for' => 'Growth-stage businesses, founders, and teams that need a high-performance digital presence or custom web product.',
                'use_cases' => ['Corporate websites', 'Product launch pages', 'Platform experiences', 'Lead generation sites', 'Custom web apps'],
                'icon' => 'o-code-bracket',
            ],
            [
                'title' => 'SaaS Product Development',
                'description' => 'We take SaaS ideas from concept to launch with product strategy, UX, and engineering aligned from day one. We help define MVP scope, build multi-tenant systems, design subscription flows, and create dashboards that make complex workflows feel simple.',
                'tools_technologies' => ['Full-stack development', 'Subscription architecture', 'Admin dashboards', 'Analytics', 'API-first systems'],
                'best_for' => 'SaaS founders, product-led teams, and businesses launching software products or expanding platform capabilities.',
                'use_cases' => ['MVPs', 'Customer portals', 'Internal tools', 'Subscription products', 'Enterprise-ready software platforms'],
                'icon' => 'o-cube',
            ],
            [
                'title' => 'Mobile App Design & Dev',
                'description' => 'We create mobile experiences that feel premium, clear, and effortless across iOS and Android. Our process combines product thinking, interaction design, and cross-platform engineering to deliver apps that are ready for real users and real-world growth.',
                'tools_technologies' => ['React Native', 'Mobile UX patterns', 'App prototyping', 'User testing', 'Design systems', 'API integrations'],
                'best_for' => 'Consumer apps, service businesses, startups, and teams bringing an app idea to market.',
                'use_cases' => ['Booking apps', 'Customer portals', 'Companion apps', 'Internal mobile tools', 'Multi-device ecosystems'],
                'icon' => 'o-device-phone-mobile',
            ],
            [
                'title' => 'CMS Development',
                'description' => 'We build elegant, easy-to-manage content systems that give teams control without sacrificing design quality. Whether you need a marketing site, ecommerce experience, or content-rich platform, we create flexible CMS setups tailored to your workflow and growth goals.',
                'tools_technologies' => ['Webflow', 'WordPress', 'Shopify', 'HubSpot', 'Squarespace', 'Magento'],
                'best_for' => 'Marketing teams, content-led brands, ecommerce businesses, and organizations that update content frequently.',
                'use_cases' => ['Launch sites', 'Blogs', 'Ecommerce storefronts', 'Campaign pages', 'Resource hubs'],
                'icon' => 'o-squares-2x2',
            ],
        ];

        foreach ($services as $index => $service) {
            Service::updateOrCreate(
                ['slug' => str($service['title'])->slug()],
                $service + ['sort_order' => $index]
            );
        }
    }
}
