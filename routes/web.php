<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TourController;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/tours', [TourController::class, 'index'])->name('tours.index');
Route::get('/tours/{slug}', [TourController::class, 'show'])->name('tours.show');
Route::post('/bookings', [App\Http\Controllers\BookingController::class, 'store'])->name('bookings.store');

Route::get('/blog', function () {
    return view('blog.index');
})->name('blog.index');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');
