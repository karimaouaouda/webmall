<?php

namespace App\Filament\Client\Resources\MessageResource\Pages;

use App\Filament\Client\Resources\MessageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMessage extends CreateRecord
{
    protected static string $resource = MessageResource::class;
}
