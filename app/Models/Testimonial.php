<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Testimonial extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['client_name', 'content', 'rating', 'is_active'];
    protected $translatable = ['content'];
    protected $casts = [
        'rating' => 'integer',
        'is_active' => 'boolean',
    ];
}
