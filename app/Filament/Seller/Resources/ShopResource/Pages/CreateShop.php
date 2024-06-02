<?php

namespace App\Filament\Seller\Resources\ShopResource\Pages;

use App\Filament\Seller\Resources\ShopResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateShop extends CreateRecord
{
    protected static string $resource = ShopResource::class;


    protected static bool $canCreateAnother = false;

}
