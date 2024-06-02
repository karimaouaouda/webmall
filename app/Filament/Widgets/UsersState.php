<?php

namespace App\Filament\Widgets;

use App\Models\Auth\Client;
use App\Models\Auth\Seller;
use App\Models\Shop;
use Filament\Support\Colors\Color;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UsersState extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('sellers', Seller::count())
                ->icon('heroicon-o-user-group')
                ->description('+296 last month')
                ->descriptionIcon('heroicon-o-arrow-trending-up')
                ->descriptionColor(Color::Green),

            Stat::make('clients', Client::count())
                ->icon('heroicon-o-user-group')
                ->description('+296 last month')
                ->descriptionIcon('heroicon-o-arrow-trending-up')
                ->descriptionColor(Color::Green),

            Stat::make('shops', Shop::count())
                ->icon('heroicon-o-building-storefront')
                ->description('+12 last month')
                ->descriptionIcon('heroicon-o-arrow-trending-down')
                ->descriptionColor(Color::Red),
        ];
    }
}
