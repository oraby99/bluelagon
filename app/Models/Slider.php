<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Slider extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['title', 'image_path', 'link', 'order', 'is_active'];
    protected $translatable = ['title'];
    protected $casts = [
        'order' => 'integer',
        'is_active' => 'boolean',
    ];
}
