<?php

namespace App\Filament\Client\Resources\CommandResource\Pages;

use App\Filament\Client\Resources\CommandResource;
use App\Filament\Client\Resources\CommandResource\Widgets\ShippingStatusView;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCommand extends ViewRecord
{
    protected static string $resource = CommandResource::class;


    public function getHeaderWidgets(): array
    {

        return [
            ShippingStatusView::class,
        ];
    }

}