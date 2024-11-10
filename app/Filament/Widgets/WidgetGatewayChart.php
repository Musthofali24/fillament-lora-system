<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Gateway;

class WidgetGatewayChart extends ChartWidget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';
    protected static ?string $heading = 'Gateway';
    protected int | string | array $contentHeight = '200px';

    // Tambahkan property untuk filter
    public ?string $filter = 'all';

    // Definisikan filter yang tersedia
    protected function getFilters(): ?array
    {
        return [
            'all' => 'Semua Gateway',
            'gateway1' => 'Gateway 1',
            'gateway2' => 'Gateway 2',
            'gateway3' => 'Gateway 3',
            // Bisa ditambahkan sesuai kebutuhan
        ];
    }

    protected function getData(): array
    {
        // Data dummy untuk masing-masing gateway
        $dataSets = [
            'all' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89],
            'gateway1' => [5, 15, 10, 7, 25, 37, 50, 79, 70, 50, 82, 94],
            'gateway2' => [3, 8, 4, 1, 18, 29, 42, 71, 62, 42, 74, 86],
            'gateway3' => [7, 12, 6, 4, 23, 34, 47, 76, 67, 47, 79, 91],
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Gateway Activity',
                    'data' => $dataSets[$this->filter] ?? $dataSets['all'],
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    // Optional: Tambahkan konfigurasi chart
    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'grid' => [
                        'display' => true,
                        'color' => '#474747',
                    ],
                ],
                'x' => [
                    'grid' => [
                        'display' => false,
                    ],
                ],
            ],
        ];
    }
}
