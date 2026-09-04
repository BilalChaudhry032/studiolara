<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Testimonial extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'quote',
        'author_name',
        'author_title',
        'company',
        'sort_order',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('photo')->singleFile();
    }
}
