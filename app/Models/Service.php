<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    /**
     * The fixed line palette, keyed by route letter. Each service takes one
     * line, which sets its bullet letter and colour everywhere on the site
     * (see the line tokens in tailwind.config.js).
     */
    public const LINES = [
        'u' => 'U · Signal red',
        'w' => 'W · Route blue',
        's' => 'S · Line green',
        'm' => 'M · Platform yellow',
        'c' => 'C · Interchange purple',
    ];

    protected $fillable = [
        'title',
        'slug',
        'line',
        'description',
        'tools_technologies',
        'best_for',
        'use_cases',
        'icon',
        'sort_order',
    ];

    protected $casts = [
        'tools_technologies' => 'array',
        'use_cases' => 'array',
    ];
}
