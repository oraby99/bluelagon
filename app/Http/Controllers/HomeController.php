<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Slider;
use App\Models\Testimonial;
use App\Models\Tour;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('is_active', true)->orderBy('order')->get();
        $categories = Category::where('is_active', true)->get();
        $featuredTours = Tour::with(['media', 'category'])->where('is_active', true)->latest()->take(6)->get();
        $testimonials = Testimonial::where('is_active', true)->latest()->take(3)->get();

        return view('home', compact('sliders', 'categories', 'featuredTours', 'testimonials'));
    }
}
