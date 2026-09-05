<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\CaseStudy;
use Illuminate\Support\Facades\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $urls = collect([
            ['loc' => route('home'), 'priority' => '1.0'],
            ['loc' => route('about'), 'priority' => '0.8'],
            ['loc' => route('team'), 'priority' => '0.6'],
            ['loc' => route('services.index'), 'priority' => '0.9'],
            ['loc' => route('work.index'), 'priority' => '0.9'],
            ['loc' => route('pricing'), 'priority' => '0.8'],
            ['loc' => route('blog.index'), 'priority' => '0.7'],
            ['loc' => route('contact'), 'priority' => '0.8'],
        ]);

        $urls = $urls->merge(
            CaseStudy::all()->map(fn (CaseStudy $project) => [
                'loc' => route('work.show', $project),
                'lastmod' => $project->updated_at->toAtomString(),
                'priority' => '0.7',
            ])
        );

        $urls = $urls->merge(
            BlogPost::whereNotNull('published_at')->get()->map(fn (BlogPost $post) => [
                'loc' => route('blog.show', $post),
                'lastmod' => $post->updated_at->toAtomString(),
                'priority' => '0.6',
            ])
        );

        return Response::view('sitemap', ['urls' => $urls])
            ->header('Content-Type', 'text/xml');
    }

    /**
     * Dynamic, not a static public/robots.txt file, because the Sitemap
     * directive must be an absolute URL per the robots.txt spec (a relative
     * one fails Lighthouse's "robots.txt is not valid" SEO audit) - and the
     * real production domain isn't finalized yet (see Phase 8).
     */
    public function robots()
    {
        $lines = [
            'User-agent: *',
            'Disallow: /admin',
            'Allow: /',
            '',
            'Sitemap: ' . route('sitemap'),
        ];

        return Response::make(implode("\n", $lines) . "\n", 200, [
            'Content-Type' => 'text/plain',
        ]);
    }
}
