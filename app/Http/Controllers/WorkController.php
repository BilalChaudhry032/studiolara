<?php

namespace App\Http\Controllers;

use App\Models\CaseStudy;
use App\Models\Service;

class WorkController extends Controller
{
    public function index()
    {
        $services = Service::whereNotNull('line')->orderBy('sort_order')->get();

        return view('pages.work.index', [
            'projects' => CaseStudy::orderBy('sort_order')->get(),
            'services' => $services,
            'lineByService' => $services->pluck('line', 'title'),
        ]);
    }

    public function show(CaseStudy $project)
    {
        $services = Service::whereNotNull('line')->orderBy('sort_order')->get();
        $order = CaseStudy::orderBy('sort_order')->pluck('id');
        $position = $order->search($project->id);

        return view('pages.work.show', [
            'project' => $project,
            // The next journey along, wrapping round to the first.
            'next' => $order->count() > 1 ? CaseStudy::find($order[($position + 1) % $order->count()]) : null,
            'services' => $services,
            'lineByService' => $services->pluck('line', 'title'),
        ]);
    }
}
