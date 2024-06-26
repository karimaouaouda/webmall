<?php

namespace App\Filament\Seller\Resources\ShopResource\Pages;

use App\Enums\ShopStatus;
use App\Filament\Seller\Resources\ShopResource;
use App\Models\Shop\Document;
use Filament\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
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
                ->visible(auth('seller')->user()->shop->document == null)
                ->form([
                    Wizard::make([
                        Step::make('informations')
                            ->schema([
                                Hidden::make('shop_unique_name')
                                    ->default(auth('seller')->user()->shop->unique_name)
                                    ->required(),

                                Hidden::make('status')
                                    ->default(ShopStatus::Processing->value)
                                    ->required(),

                                TextInput::make('serial_number')
                                    ->label('serial number')
                                    ->required(),

                                DatePicker::make('starts_at')
                                    ->label('business start in')
                                    ->required()
                            ]),

                        Step::make('agreement files')
                            ->schema([
                                FileUpload::make('document')
                                    ->disk('public')
                                    ->directory(function(){
                                        $seller_id = auth('seller')->id();
                                        return "sellers/seller_{$seller_id}/shop/documents";
                                    })
                                    ->required()
                            ])
                    ])
                ])
                ->icon("heroicon-o-arrow-right")
                ->model(Document::class)
        ];
    }
}
