<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Category;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function index(Request $request)
    {
        $query = Tour::where('is_active', true);

        if ($request->has('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $tours = $query->with('category')->latest()->paginate(12);
        $categories = Category::where('is_active', true)->get();

        return view('tours.index', compact('tours', 'categories'));
    }

    public function show($slug)
    {
        $tour = Tour::where('slug', $slug)->where('is_active', true)->firstOrFail();
        return view('tours.show', compact('tour'));
    }
}
