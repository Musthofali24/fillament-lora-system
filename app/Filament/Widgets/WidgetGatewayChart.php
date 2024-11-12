<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Node;
use App\Models\Data;

class WidgetGatewayChart extends ChartWidget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';
    protected static ?string $heading = 'Water Level';
    protected int | string | array $contentHeight = '100px';
    protected static ?string $pollingInterval = '15s';

    public ?string $filter = 'all';

    // Tambahkan method untuk tampilan saat tidak ada data
    protected function getEmptyStateDescription(): ?string
    {
        return 'No data available';
    }

    // Tambahkan method untuk icon saat tidak ada data
    protected function getEmptyStateIcon(): ?string
    {
        return 'heroicon-o-x-mark';  // atau icon lain yang sesuai
    }

    protected function getFilters(): ?array
    {
        $nodes = Node::pluck('node_id', 'id')->toArray();
        return array_merge(
            ['all' => 'Semua Node'],
            $nodes
        );
    }

    protected function getData(): array
    {
        $query = Data::query();

        if ($this->filter !== 'all') {
            $query->where('node_id', $this->filter);
        }

        $data = $query->select('water_level', 'created_at')
            ->latest()
            ->limit(12)
            ->orderBy('created_at', 'asc')
            ->get();

        // Jika data kosong, kembalikan array kosong
        if ($data->isEmpty()) {
            return [
                'datasets' => [
                    [
                        'label' => 'Water Level',
                        'data' => [],
                        'backgroundColor' => '#36A2EB',
                        'borderColor' => '#9BD0F5',
                    ],
                ],
                'labels' => [],
            ];
        }

        return [
            'datasets' => [
                [
                    'label' => 'Water Level',
                    'data' => $data->pluck('water_level'),
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => $data->map(function ($item) {
                return $item->created_at->format('H:i:s');
            })->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

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
