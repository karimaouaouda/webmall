<?php

namespace App\Filament\Seller\Resources\ShopResource\Pages;

use App\Filament\Seller\Resources\ShopResource;
use Filament\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard\Step;
use Filament\Resources\Pages\ViewRecord;

class ViewShop extends ViewRecord
{
    protected static string $resource = ShopResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make('verify shop now !')
                ->label('verify shop now !')
                ->icon("heroicon-o-arrow-right")
                ->steps([
                    Step::make('shop illegal information')
                        ->schema([
                            TextInput::make('serial_number')
                                ->label('serial number')
                                ->required(),

                            DatePicker::make('start_date')
                                ->label('business start in')
                                ->required()
                        ]),

                    Step::make('shop agreement picture')
                        ->label('shop agreement from algerien governement')
                        ->schema([
                            FileUpload::make('agreement')
                                ->image()
                                ->required(),
                        ])
                ])
        ];
    }
}
