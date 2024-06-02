<?php

namespace App\Filament\Seller\Widgets;

use Filament\Facades\Filament;
use Filament\Widgets\ChartWidget;

class ProfileAnalysis extends ChartWidget
{
    protected static ?string $heading = 'Chart';


    public static function canView(): bool
    {
        $user = Filament::auth()->user();
        return false;
    }

    protected function getData(): array
    {
        return [
            //
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
