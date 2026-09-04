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
}
