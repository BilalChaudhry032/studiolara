<?php

// Studio's public contact details. The defaults are placeholders until the
// real ones arrive (REDESIGN_PLAN.md §11); set them in .env, not here.
return [
    'email' => env('STUDIO_EMAIL', 'contact@agency.com'),
    'careers_email' => env('STUDIO_CAREERS_EMAIL', 'careers@agency.com'),
    'phone' => env('STUDIO_PHONE', '+1 (555) 123-4567'),
    'location' => env('STUDIO_LOCATION', 'New York, USA'),
    'calendly_url' => env('STUDIO_CALENDLY_URL', 'https://calendly.com/your-agency/strategy-call'),

    // The five stations every project rides. The copy comes from the SRS, and
    // "gets" lists deliverables already named in the services and plans.
    'process' => [
        ['name' => 'Discover', 'summary' => 'Understand your users, business model, and goals.', 'gets' => ['Product discovery & strategy session', 'User research']],
        ['name' => 'Define', 'summary' => 'Translate research into a focused strategy and scope.', 'gets' => ['Product strategy & user flows', 'Journey mapping']],
        ['name' => 'Design', 'summary' => 'Design with conversion, clarity, and confidence in mind.', 'gets' => ['UX wireframes & prototypes', 'Design system & polished UI']],
        ['name' => 'Build', 'summary' => 'Build with scalability, performance, and stability at the core.', 'gets' => ['Full-stack development', 'Database architecture & API design', 'CMS setup']],
        ['name' => 'Refine', 'summary' => 'Refine based on real feedback and performance data.', 'gets' => ['Usability testing', 'SEO optimization']],
    ],
];
