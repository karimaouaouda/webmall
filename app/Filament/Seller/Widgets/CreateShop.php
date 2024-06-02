<?php

namespace App\Filament\Seller\Widgets;

use Filament\Widgets\Widget;

class CreateShop extends Widget
{
    protected static string $view = 'filament.seller.widgets.create-shop';

    public static function canView(): bool
    {
        $seller = auth("seller")->user();
        return !($seller->has_shop && $seller->shop->isPublished());
    }

    protected int | string | array $columnSpan = 2;
    protected function getViewData(): array
    {
        return [
            'seller' => auth('seller')->user()
        ];
    }
}
