<?php

namespace App\Filament\Resources\ScalePredictionResource\Pages;

use App\Filament\Resources\ScalePredictionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListScalePredictions extends ListRecords
{
    protected static string $resource = ScalePredictionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
