<?php

namespace App\Filament\Approver\Widgets;

use App\Models\Vehicle;
use Filament\Widgets\ChartWidget;

class VehicleUsageBarChart extends ChartWidget
{
    protected static ?string $heading = 'Riwayat Pemakaian Kendaraan per Bulan';

    public function getType(): string
    {
        return 'bar';
    }

    protected function getData(): array
    {
        // Buat label bulan tetap 1-12
        $bulanLabels = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
            5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu',
            9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des',
        ];

        $labels = array_values($bulanLabels); // ['Jan', 'Feb', ...]
        $datasets = [];

        // Ambil semua kendaraan
        $vehicles = Vehicle::with(['bookings' => function ($q) {
            $q->selectRaw('vehicle_id, MONTH(start_time) as bulan, COUNT(*) as total')
                ->where('current_approval', 2)
              ->groupBy('vehicle_id', 'bulan');
        }])->get();

        // Warna default (bisa disesuaikan)
        $colors = [
            'rgba(59, 130, 246, 0.7)',    // biru
            'rgba(234, 179, 8, 0.8)',     // amber
            'rgba(34, 197, 94, 0.7)',     // hijau
            'rgba(239, 68, 68, 0.7)',     // merah
            'rgba(168, 85, 247, 0.7)',    // ungu
        ];

        foreach ($vehicles as $index => $vehicle) {
            $bulanData = array_fill(1, 12, 0); // 12 bulan

            foreach ($vehicle->bookings as $booking) {
                $bulanData[(int)$booking->bulan] = $booking->total;
            }

            $datasets[] = [
                'label' => $vehicle->name,
                'data' => array_values($bulanData),
                'backgroundColor' => $colors[$index % count($colors)],
            ];
        }

        return [
            'labels' => $labels,
            'datasets' => $datasets,
        ];
    }
}

