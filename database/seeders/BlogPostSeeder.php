<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    /**
     * Seeded from the SRS PDF's "Featured Articles" list (titles + short
     * blurbs only - no full article bodies existed in the source). Body
     * text below expands the blurb into a short placeholder post; treat as
     * a first draft to be replaced with real long-form writing.
     */
    public function run(): void
    {
        $posts = [
            [
                'title' => 'The Product-First Approach: Why Design Thinking Matters Before Code',
                'category' => 'Product Strategy',
                'excerpt' => 'Explore how prioritizing user needs and strategic design thinking before jumping into development can save time, reduce costs, and lead to more successful products.',
                'reading_time' => 6,
            ],
            [
                'title' => 'Conversion Rate Optimization: 5 Design Patterns That Drive Results',
                'category' => 'Design & UX',
                'excerpt' => 'Uncover actionable UI/UX design patterns proven to boost conversion rates and enhance user engagement on your website or application.',
                'reading_time' => 5,
            ],
            [
                'title' => 'Scaling Your SaaS: Technical Architecture Decisions That Matter',
                'category' => 'Development & Engineering',
                'excerpt' => 'Learn about critical architectural choices that enable your SaaS platform to scale efficiently, maintain performance, and support rapid growth.',
                'reading_time' => 8,
            ],
            [
                'title' => 'From Idea to Launch: The Complete Product Development Roadmap',
                'category' => 'Product Strategy',
                'excerpt' => 'A step-by-step guide through the entire product lifecycle, from initial concept validation to successful market launch and beyond.',
                'reading_time' => 7,
            ],
        ];

        foreach ($posts as $post) {
            $category = BlogCategory::where('name', $post['category'])->first();

            BlogPost::updateOrCreate(
                ['slug' => str($post['title'])->slug()],
                [
                    'title' => $post['title'],
                    'excerpt' => $post['excerpt'],
                    'body' => "<p>{$post['excerpt']}</p><p>Full article content coming soon.</p>",
                    'blog_category_id' => $category?->id,
                    'author' => 'Studio Team',
                    'reading_time' => $post['reading_time'],
                    'published_at' => now(),
                ]
            );
        }
    }
}
