<?php

namespace App\Filament\Resources\VideosResource\Pages;

use App\Filament\Resources\VideosResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVideos extends ListRecords
{
    protected static string $resource = VideosResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
