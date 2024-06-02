<?php

namespace App\Filament\Seller\Dynamic\Pages;

use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Page;

class ShopSettings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';

    protected static string $view = 'filament.seller.pages.shop-settings';

    protected function getViewData(): array
    {
        return [
            'seller' => auth('seller')->user()
        ];
    }

    public static function getRoutePath(): string
    {
        return '/shop/settings';
    }

    public static function canAccess(): bool
    {
        $user = Filament::auth()->user();
        return $user->hasAddress() && $user->hasVerifiedID();
    }
}
