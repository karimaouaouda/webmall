<?php

namespace App\Filament\Seller\Widgets;

use Filament\Widgets\ChartWidget;

class ProfileAnalysis extends ChartWidget
{
    protected static ?string $heading = 'Chart';

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
