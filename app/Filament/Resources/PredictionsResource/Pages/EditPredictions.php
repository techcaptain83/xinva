<?php

namespace App\Filament\Resources\PredictionsResource\Pages;

use App\Filament\Resources\PredictionsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPredictions extends EditRecord
{
    protected static string $resource = PredictionsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
