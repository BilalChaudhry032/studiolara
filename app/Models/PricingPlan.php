<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricingPlan extends Model
{
    protected $fillable = [
        'name',
        'tagline',
        'price_range',
        'timeline',
        'deliverables',
        'best_for',
        'featured',
        'sort_order',
    ];

    protected $casts = [
        'deliverables' => 'array',
        'featured' => 'boolean',
    ];

    /** The lowest price in the range, e.g. "$2,000" from "$2,000 – $7,500" or "Custom Pricing (starts at $25,000+)". */
    public function getFareFromAttribute(): ?string
    {
        return preg_match('/\$[\d,]+/', $this->price_range, $m) ? $m[0] : null;
    }

    /** Departure-board form of the timeline: "3 – 8 weeks" becomes "3–8 WKS", "6 months – 12+ months" becomes "6–12+ MOS". */
    public function getShortTimelineAttribute(): string
    {
        $timeline = preg_replace('/(\d+\+?)\s*(\w+)\s*–\s*(\d+\+?)\s*\2/u', '$1–$3 $2', $this->timeline);
        $timeline = preg_replace('/\s*–\s*/u', '–', $timeline);

        return strtr(mb_strtoupper($timeline), ['WEEKS' => 'WKS', 'MONTHS' => 'MOS']);
    }
}
