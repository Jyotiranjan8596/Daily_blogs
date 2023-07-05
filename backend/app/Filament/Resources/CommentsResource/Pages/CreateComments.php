<?php

namespace App\Filament\Resources\CommentsResource\Pages;

use App\Filament\Resources\CommentsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateComments extends CreateRecord
{
    protected static string $resource = CommentsResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
