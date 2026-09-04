<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\BlogPost;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::with('category')
            ->whereNotNull('published_at')
            ->orderByDesc('published_at')
            ->paginate(9);

        $categories = BlogCategory::orderBy('name')->get();

        return view('pages.blog.index', compact('posts', 'categories'));
    }

    public function show(BlogPost $post)
    {
        $post->load('category');

        return view('pages.blog.show', compact('post'));
    }
}
