<?php

namespace App\Filament\Widgets;

use App\Models\Node;
use App\Models\Gateway;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;
    protected static ?string $pollingInterval = '15s';
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        // Hitung total Gateway
        $totalGateways = Gateway::count();
        $previousGateways = Gateway::where('created_at', '<', now()->subMonth())->count();
        $gatewayIncrease = $totalGateways - $previousGateways;

        // Hitung total Node
        $totalNodes = Node::count();
        $previousNodes = Node::where('created_at', '<', now()->subMonth())->count();
        $nodeIncrease = $totalNodes - $previousNodes;

        return [
            Stat::make('Jumlah Gateway', $totalGateways)
                ->description($gatewayIncrease > 0 ? "+$gatewayIncrease dari bulan lalu" : "$gatewayIncrease dari bulan lalu")
                ->descriptionIcon($gatewayIncrease > 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($gatewayIncrease > 0 ? 'success' : 'danger'),

            Stat::make('Jumlah Node', $totalNodes)
                ->description($nodeIncrease > 0 ? "+$nodeIncrease dari bulan lalu" : "$nodeIncrease dari bulan lalu")
                ->descriptionIcon($nodeIncrease > 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($nodeIncrease > 0 ? 'success' : 'danger'),
        ];
    }
}
