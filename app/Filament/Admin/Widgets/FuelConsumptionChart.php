<?php

namespace App\Filament\Admin\Widgets;

use App\Models\FuelLog;
use App\Models\Vehicle;
use Filament\Widgets\ChartWidget;

class FuelConsumptionChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Konsumsi BBM per Bulan per Kendaraan';

    public function getType(): string
    {
        return 'bar';
    }

    protected function getData(): array
    {
        $bulanLabels = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
            5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu',
            9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des',
        ];

        $labels = array_values($bulanLabels);
        $datasets = [];

        // Warna untuk tiap kendaraan (bisa ditambah)
        $colors = [
            'rgba(234, 179, 8, 0.8)',     // amber
            'rgba(59, 130, 246, 0.7)',    // biru
            'rgba(34, 197, 94, 0.7)',     // hijau
            'rgba(239, 68, 68, 0.7)',     // merah
            'rgba(168, 85, 247, 0.7)',    // ungu
        ];

        // Ambil semua kendaraan
        $vehicles = Vehicle::with(['fuelLogs' => function ($query) {
            $query->selectRaw('vehicle_id, MONTH(tanggal) as bulan, SUM(jumlah_liter) as total')
                ->groupBy('vehicle_id', 'bulan');
        }])->get();

        foreach ($vehicles as $index => $vehicle) {
            $perBulan = array_fill(1, 12, 0);

            foreach ($vehicle->fuelLogs as $log) {
                $perBulan[(int)$log->bulan] = $log->total;
            }

            $datasets[] = [
                'label' => $vehicle->name,
                'data' => array_values($perBulan),
                'backgroundColor' => $colors[$index % count($colors)],
            ];
        }

        return [
            'labels' => $labels,
            'datasets' => $datasets,
        ];
    }
}
