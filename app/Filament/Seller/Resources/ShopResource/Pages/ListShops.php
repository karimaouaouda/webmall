<?php

namespace App\Filament\Seller\Resources\ShopResource\Pages;

use App\Filament\Seller\Resources\ShopResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListShops extends ListRecords
{
    protected static string $resource = ShopResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('create my shop'),
        ];
    }
}
