<?php

namespace App\Http\Controllers;

use App\Models\CaseStudy;
use App\Models\PricingPlan;
use App\Models\Service;

class PageController extends Controller
{
    public function home()
    {
        $services = Service::whereNotNull('line')->orderBy('sort_order')->get();

        return view('pages.home', [
            'services' => $services,
            'lineByService' => $services->pluck('line', 'title'),
            'featuredCaseStudies' => CaseStudy::orderBy('sort_order')->take(3)->get(),
            'plans' => PricingPlan::orderBy('sort_order')->get(),
            'process' => config('studio.process'),
        ]);
    }

    public function services()
    {
        return view('pages.services.index', [
            'services' => Service::whereNotNull('line')->orderBy('sort_order')->get(),
            'process' => config('studio.process'),
        ]);
    }

    public function service(Service $service)
    {
        $lines = Service::whereNotNull('line')->orderBy('sort_order')->get();

        return view('pages.services.show', [
            'service' => $service,
            'interchanges' => $lines->where('id', '!=', $service->id),
            'lineByService' => $lines->pluck('line', 'title'),
            // service_tags is a JSON list; SQLite has no JSON-contains query, and there are only a handful of rows.
            'journeys' => CaseStudy::orderBy('sort_order')->get()->filter(fn (CaseStudy $study) => in_array($service->title, $study->service_tags ?? [], true)),
        ]);
    }

    public function pricing()
    {
        return view('pages.pricing', [
            'plans' => PricingPlan::orderBy('sort_order')->get(),
        ]);
    }
}
