<?php

namespace App\Filament\Seller\Widgets;

use Filament\Support\Colors\Color;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('shop visits', '1254')
                ->icon('heroicon-o-user')
                ->description('+245 last month')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->descriptionColor(Color::Green),

            Stat::make('products purchasing', '1258')
                ->icon('heroicon-o-currency-dollar')
                ->description('+158 last month')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->descriptionColor(Color::Green),

            Stat::make('posts reactions', '2587')
                ->icon('heroicon-o-user-group')
                ->description('+555 last month')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->descriptionColor(Color::Red),
        ];
    }
}
