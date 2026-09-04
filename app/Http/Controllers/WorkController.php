<?php

namespace App\Http\Controllers;

use App\Models\CaseStudy;

class WorkController extends Controller
{
    public function index()
    {
        $projects = CaseStudy::orderBy('sort_order')->get();

        $categories = $projects->pluck('category')->filter()->unique()->values();

        return view('pages.work.index', compact('projects', 'categories'));
    }

    public function show(CaseStudy $project)
    {
        return view('pages.work.show', compact('project'));
    }
}
