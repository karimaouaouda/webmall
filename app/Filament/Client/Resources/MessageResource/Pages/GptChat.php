<?php

namespace App\Filament\Client\Resources\MessageResource\Pages;

use App\Filament\Client\Resources\MessageResource;
use Filament\Resources\Pages\Page;

class GptChat extends Page
{
    protected static string $resource = MessageResource::class;


    protected function getViewData(): array
    {
        return [
            'messages' => auth('client')->user()->messages,
        ];
    }

    protected static string $view = 'filament.client.resources.message-resource.pages.gpt-chat';
}
