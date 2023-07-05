<?php

namespace App\Filament\Resources\VideosResource\Pages;

use App\Filament\Resources\VideosResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVideos extends EditRecord
{
    protected static string $resource = VideosResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
