<?php

namespace App\Filament\Approver\Widgets;

use App\Models\VehicleBooking;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class ApproverDashboardStats extends BaseWidget
{
    protected function getCards(): array
    {
        $user = auth()->user();

        if (! $user) {
            return [];
        }

        $role = $user->role;

        $pending = 0;

        if ($role === 'kepala_cabang') {
            $pending = VehicleBooking::where('approval_status', 'pending')
                ->where('current_approval', 0)
                ->count();
        } elseif ($role === 'kepala_pusat') {
            $pending = VehicleBooking::where('approval_status', 'pending')
                ->where('current_approval', 1)
                ->count();
        }

        $approved = VehicleBooking::where('approval_status', 'approved')->count();
        $rejected = VehicleBooking::where('approval_status', 'rejected')->count();

        return [
            Stat::make('Menunggu Persetujuan', $pending),
            Stat::make('Disetujui', $approved),
            Stat::make('Ditolak', $rejected),
        ];
    }
}
