<?php

namespace App\Filament\Seller\Resources\ProductResource\Pages;

use App\Filament\Seller\Resources\ProductResource;
use App\Filament\Seller\Resources\ProductResource\Widgets\AddToCart;
use App\Filament\Seller\Resources\ProductResource\Widgets\ProductSells;
use Filament\Actions;
use Filament\Navigation\NavigationItem;
use Filament\Resources\Pages\ViewRecord;

class View extends ViewRecord
{
    protected static string $resource = ProductResource::class;

    public static function navigationItems(){
        $label = "bibich";
        $url = "tahan";
        return [
            NavigationItem::make($label, $url)
            ->icon($icon = 'heroicon-o-document-text')
            ->sort($sort = 0),
        ];
    }


    public function getVisibleHeaderWidgets(): array
    {
        return [
            ProductSells::make(),
            AddToCart::make(),
        ];
    }
}
