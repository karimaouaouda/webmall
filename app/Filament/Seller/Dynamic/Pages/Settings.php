<?php

namespace App\Filament\Seller\Dynamic\Pages;

use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\FileUpload;
use Filament\Pages\Page;

class Settings extends Page
{
    protected static string $routePath = '/settings';
    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';

    protected static string $view = 'filament.seller.pages.settings';

    protected static ?int $navigationSort = 1;


    protected function getViewData(): array
    {
        return [
            'seller' => auth('seller')->user()
        ];
    }
}
