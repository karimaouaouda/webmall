<?php

namespace App\Filament\Client\Resources\CommandResource\Widgets;

use App\Models\Shop\Product;
use Filament\Widgets\Widget;

class ShippingStatusView extends Widget
{
    protected static string $view = 'filament.client.resources.command-resource.widgets.shipping-status-view';

    protected function getViewData(): array
    {
        return [
            'product' => "Processing",
        ];
    }





}