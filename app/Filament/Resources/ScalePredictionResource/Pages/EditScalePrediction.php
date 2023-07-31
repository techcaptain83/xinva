<?php

namespace App\Filament\Resources\ScalePredictionResource\Pages;

use App\Filament\Resources\ScalePredictionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditScalePrediction extends EditRecord
{
    protected static string $resource = ScalePredictionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
