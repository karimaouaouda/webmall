<?php

namespace App\Filament\Seller\Resources\CommandResource\Pages;

use App\Filament\Seller\Resources\CommandResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCommand extends CreateRecord
{
    protected static string $resource = CommandResource::class;
}
