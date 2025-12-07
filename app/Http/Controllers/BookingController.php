<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Tour;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'user_name' => 'required|string|max:255',
            'user_phone' => 'required|string|max:255',
            'booking_date' => 'required|date',
            'persons_count' => 'required|integer|min:1',
            'pickup_location' => 'nullable|string|max:255',
        ]);

        $booking = Booking::create([
            'tour_id' => $validated['tour_id'],
            'user_name' => $validated['user_name'],
            'user_phone' => $validated['user_phone'],
            'booking_date' => $validated['booking_date'],
            'persons_count' => $validated['persons_count'],
            'pickup_location' => $validated['pickup_location'],
            'status' => 'pending',
            'source' => 'website',
        ]);

        $tour = Tour::find($validated['tour_id']);

        // Notify Admins
        $admins = \App\Models\User::all();
        foreach ($admins as $admin) {
            \Filament\Notifications\Notification::make()
                ->title('New Booking')
                ->body("{$validated['user_name']} booked {$tour->name}")
                ->success()
                ->actions([
                    \Filament\Notifications\Actions\Action::make('view')
                        ->button()
                        ->url(\App\Filament\Resources\BookingResource::getUrl('edit', ['record' => $booking])),
                ])
                ->sendToDatabase($admin);
        }

        $message = "Hello, I would like to book: {$tour->name}\n" .
            "Date: {$validated['booking_date']}\n" .
            "Persons: {$validated['persons_count']}\n" .
            "Name: {$validated['user_name']}\n" .
            "Pickup: " . ($validated['pickup_location'] ?? 'Not specified');

        $whatsappUrl = "https://wa.me/201000000000?text=" . urlencode($message);

        return response()->json([
            'success' => true,
            'whatsapp_url' => $whatsappUrl,
        ]);
    }
}
