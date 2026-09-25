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
        'is_sample',
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
        'headline_result',
        'duration_label',
        'testimonial_quote',
        'testimonial_author',
        'testimonial_title',
        'published_at',
        'sort_order',
    ];

    protected $casts = [
        'is_sample' => 'boolean',
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
        // The departure/arrival pair for the before/after comparison.
        $this->addMediaCollection('before')->singleFile();
        $this->addMediaCollection('after')->singleFile();
        // A short muted walkthrough: an MP4 (H.264) and a WebM, plus its poster frame.
        $this->addMediaCollection('video')->acceptsMimeTypes(['video/mp4', 'video/webm'])->onlyKeepLatest(2);
        $this->addMediaCollection('video_poster')->singleFile();
    }

    /** Line keys (u, w, s, m, c) of the services this study used, given a service title => line map. */
    public function linesFrom($lineByService): array
    {
        return collect($this->service_tags)->map(fn ($tag) => $lineByService[$tag] ?? null)->filter()->values()->all();
    }

    /** The walkthrough's sources, WebM first so browsers that play it take the smaller file. */
    public function videoSources(): array
    {
        return $this->getMedia('video')
            ->sortBy(fn (Media $media) => $media->mime_type === 'video/webm' ? 0 : 1)
            ->map(fn (Media $media) => ['src' => $media->getUrl(), 'type' => $media->mime_type])
            ->values()
            ->all();
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

        // WebP versions for the page; the stored originals keep their provenance.
        $images = ['cover', 'gallery', 'before', 'after', 'video_poster'];
        $this->addMediaConversion('medium')->width(960)->format('webp')->quality(80)->performOnCollections(...$images)->nonQueued();
        $this->addMediaConversion('large')->width(1920)->format('webp')->quality(78)->performOnCollections(...$images)->nonQueued();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
