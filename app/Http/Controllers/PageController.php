<?php

namespace App\Http\Controllers;

use App\Models\CaseStudy;
use App\Models\PricingPlan;
use App\Models\Service;
use App\Models\Testimonial;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home', [
            'services' => Service::orderBy('sort_order')->get(),
            'featuredCaseStudies' => CaseStudy::orderBy('sort_order')->take(3)->get(),
            'testimonial' => Testimonial::orderBy('sort_order')->first(),
        ]);
    }

    public function services()
    {
        return view('pages.services.index', [
            'services' => Service::orderBy('sort_order')->get(),
            'featuredCaseStudies' => CaseStudy::orderBy('sort_order')->take(3)->get(),
            'testimonial' => Testimonial::orderBy('sort_order')->first(),
        ]);
    }

    public function pricing()
    {
        return view('pages.pricing', [
            'plans' => PricingPlan::orderBy('sort_order')->get(),
        ]);
    }
}
