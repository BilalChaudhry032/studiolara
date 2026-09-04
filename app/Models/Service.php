<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title',
        'slug',
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
