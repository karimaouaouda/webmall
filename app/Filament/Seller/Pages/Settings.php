<?php

namespace App\Filament\Seller\Pages;

use Filament\Pages\Page;
use Illuminate\Contracts\View\View;

class Settings extends Page
{
    protected static string $routePath = '/settings';
    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';

    protected static string $view = 'filament.seller.pages.settings';

    protected static ?int $navigationSort = 1;

    public static function getRoutePath(): string
    {
        return \App\Filament\Seller\Resources\ProductResource\Pages\ListProducts::getRoutePath();
    }
}
