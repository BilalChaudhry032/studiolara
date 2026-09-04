<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ServiceSeeder::class,
            PricingPlanSeeder::class,
            TestimonialSeeder::class,
            TeamMemberSeeder::class,
            BlogCategorySeeder::class,
            BlogPostSeeder::class,
            CaseStudySeeder::class,
        ]);
    }
}
