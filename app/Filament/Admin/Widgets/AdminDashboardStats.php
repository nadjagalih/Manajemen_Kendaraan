<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Vehicle;
use App\Models\VehicleBooking;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminDashboardStats extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    protected function getCards(): array
    {
        return [
            Stat::make('Total Pemesanan', VehicleBooking::count()),
            Stat::make('Pending', VehicleBooking::where('approval_status', 'pending')->count()),
            Stat::make('Approved', VehicleBooking::where('approval_status', 'approved')->count()),
            Stat::make('Rejected', VehicleBooking::where('approval_status', 'rejected')->count()),
            Stat::make('Jumlah Kendaraan', Vehicle::count()),
        ];
    }
}
