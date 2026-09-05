<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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

    /**
     * Non-queued: no queue worker runs in local dev (see PROJECT_PLAN_AND_
     * PROGRESS.md S3 env notes), so a queued conversion would just never
     * generate. Revisit at Phase 8 once a worker is running in production.
     */
    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(800)
            ->quality(80)
            ->nonQueued();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
