<?php

namespace App\Filament\Seller\Resources\ProductResource\Widgets;

use Filament\Widgets\ChartWidget;

class AddToCart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Blog posts created',
                    'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89, 90],
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89],
        ];
    }

    protected function getType(): string
    {
        return 'scatter';
    }
}
