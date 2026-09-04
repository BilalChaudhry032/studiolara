<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Seeder;

class BlogCategorySeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            'Product Strategy',
            'Design & UX',
            'Development & Engineering',
            'SaaS & Growth',
            'Case Studies',
            'Industry Insights',
        ] as $name) {
            BlogCategory::updateOrCreate(
                ['slug' => str($name)->slug()],
                ['name' => $name]
            );
        }
    }
}
