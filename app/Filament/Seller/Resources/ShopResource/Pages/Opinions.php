<?php

namespace App\Filament\Seller\Resources\ShopResource\Pages;

use App\Filament\Seller\Resources\ShopResource;
use Filament\Actions;
use Filament\Facades\Filament;
use Filament\Pages\Page;
use Filament\Resources\Pages\ViewRecord;

class Opinions extends Page
{
    // protected static string $resource = ShopResource::class;

    protected static ?string $navigationGroup = "Shop";

    public static function canAccess(): bool
    {
        $user = Filament::auth()->user();
        return $user->has_shop && $user->shop->isPublished();
    }

    protected static ?string $navigationIcon = "heroicon-o-user";
}
