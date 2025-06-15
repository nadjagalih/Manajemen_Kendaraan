<?php

namespace App\Filament\Approver\Widgets;

use App\Models\VehicleBooking;
use Filament\Widgets\BarChartWidget;

class VehicleUsageBarChart extends BarChartWidget
{
    protected static ?string $heading = 'Riwayat Pemakaian Kendaraan per Bulan';

    protected function getData(): array
    {
        // Ambil data booking dan group by bulan
        $data = VehicleBooking::selectRaw('MONTH(start_time) as bulan, COUNT(*) as total')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan');

        // Buat array nama bulan (1 => Januari, dst.)
        $bulanLabels = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
            5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu',
            9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des',
        ];

        // Pastikan semua bulan ditampilkan meski 0 booking
        $labels = [];
        $values = [];
        foreach ($bulanLabels as $key => $label) {
            $labels[] = $label;
            $values[] = $data[$key] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Booking',
                    'data' => $values,
                    'backgroundColor' => 'rgba(59, 130, 246, 0.7)',
                ],
            ],
            'labels' => $labels,
        ];
    }
}
