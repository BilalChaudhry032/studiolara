<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class CaseStudy extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'client',
        'category',
        'about',
        'tools',
        'service_tags',
        'challenges',
        'problems_solutions',
        'outcome_results',
        'testimonial_quote',
        'testimonial_author',
        'testimonial_title',
        'published_at',
        'sort_order',
    ];

    protected $casts = [
        'tools' => 'array',
        'service_tags' => 'array',
        'challenges' => 'array',
        'problems_solutions' => 'array',
        'published_at' => 'datetime',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover')->singleFile();
        $this->addMediaCollection('gallery');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
