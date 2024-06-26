<?php

namespace App\Filament\Seller\Resources\CommandResource\Pages;

use App\Filament\Seller\Resources\CommandResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCommands extends ListRecords
{
    protected static string $resource = CommandResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
