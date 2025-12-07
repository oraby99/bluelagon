<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_id',
        'user_name',
        'user_phone',
        'booking_date',
        'persons_count',
        'pickup_location',
        'status',
        'source'
    ];

    protected $casts = [
        'booking_date' => 'date',
        'persons_count' => 'integer',
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
