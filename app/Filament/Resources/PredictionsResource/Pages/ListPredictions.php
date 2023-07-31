<?php

namespace App\Filament\Resources\PredictionsResource\Pages;

use App\Filament\Resources\PredictionsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPredictions extends ListRecords
{
    protected static string $resource = PredictionsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
