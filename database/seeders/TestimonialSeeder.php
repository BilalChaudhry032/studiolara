<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        Testimonial::updateOrCreate(
            ['author_name' => 'Jane Doe'],
            [
                'quote' => "Our collaboration with Studio transformed our product vision into a market-leading reality. Their strategic insight, meticulous design, and robust engineering delivered results far beyond our expectations. They truly are partners in innovation.",
                'author_title' => 'CEO',
                'company' => 'Tech Solutions Inc.',
                'sort_order' => 0,
            ]
        );
    }
}
