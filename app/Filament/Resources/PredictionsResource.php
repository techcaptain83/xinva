<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PredictionsResource\Pages;
use App\Filament\Resources\PredictionsResource\RelationManagers;
use App\Models\Prediction;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PredictionsResource extends Resource
{
    protected static ?string $model = Prediction::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_id')
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('prompt')
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('prediction_id')
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('status')
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('created_at')
                ->required()
                ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_id'),
                Tables\Columns\TextColumn::make('prompt'),
                Tables\Columns\TextColumn::make('prediction_id'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('created_at'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                FilamentExportBulkAction::make('export'),
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->headerActions([
                FilamentExportHeaderAction::make('export')
            ]);
    }

    protected function getTableHeaderActions(): array
    {
        return [
            FilamentExportHeaderAction::make('Export'),
        ];
    }

    protected function getTableBulkActions(): array
    {
        return [
            FilamentExportBulkAction::make('Export'),
        ];
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPredictions::route('/'),
            'create' => Pages\CreatePredictions::route('/create'),
            'edit' => Pages\EditPredictions::route('/{record}/edit'),
        ];
    }    
}
