<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Bookings', Booking::count()),
            Stat::make('Pending Bookings', Booking::where('status', 'pending')->count()),
            Stat::make('Confirmed Bookings', Booking::where('status', 'confirmed')->count()),
        ];
    }
}
