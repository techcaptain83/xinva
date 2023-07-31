<?php

namespace App\Filament\Resources\BgremovedPredictionResource\Pages;

use App\Filament\Resources\BgremovedPredictionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBgremovedPrediction extends EditRecord
{
    protected static string $resource = BgremovedPredictionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
