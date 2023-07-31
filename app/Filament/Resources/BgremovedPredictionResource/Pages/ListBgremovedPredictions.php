<?php

namespace App\Filament\Resources\BgremovedPredictionResource\Pages;

use App\Filament\Resources\BgremovedPredictionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBgremovedPredictions extends ListRecords
{
    protected static string $resource = BgremovedPredictionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
