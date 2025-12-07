<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class BlogPost extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia;

    protected $fillable = ['title', 'slug', 'content', 'published_at', 'is_active'];
    protected $translatable = ['title', 'content'];
    protected $casts = [
        'published_at' => 'datetime',
        'is_active' => 'boolean',
    ];
}
