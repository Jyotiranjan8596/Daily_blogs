<?php

namespace App\Filament\Resources\CommentsResource\Pages;

use App\Filament\Resources\CommentsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditComments extends EditRecord
{
    protected static string $resource = CommentsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
