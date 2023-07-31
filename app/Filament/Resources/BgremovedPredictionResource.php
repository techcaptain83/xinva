<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BgremovedPredictionResource\Pages;
use App\Filament\Resources\BgremovedPredictionResource\RelationManagers;
use App\Models\BgRemovedPrediction;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BgremovedPredictionResource extends Resource
{
    protected static ?string $model = BgRemovedPrediction::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('prediction_result_id')
                ->required()
                ->maxLength(255),
            
                Forms\Components\TextInput::make('bg_prediction_id')
                ->required()
                ->maxLength(255),
            
                Forms\Components\TextInput::make('output_url')
                ->required()
                ->maxLength(255),
            
                Forms\Components\TextInput::make('generated_file_name')
                ->required()
                ->maxLength(255),
            
                Forms\Components\TextInput::make('status')
                ->required()
                ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('prediction_result_id'),
                Tables\Columns\TextColumn::make('bg_prediction_id'),
                Tables\Columns\TextColumn::make('output_url'),
                Tables\Columns\TextColumn::make('generated_file_name'),
                Tables\Columns\TextColumn::make('status'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                FilamentExportBulkAction::make('export'),

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
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    protected function getTableBulkActions(): array
    {
        return [
            FilamentExportBulkAction::make('Export'),
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBgremovedPredictions::route('/'),
            'create' => Pages\CreateBgremovedPrediction::route('/create'),
            'edit' => Pages\EditBgremovedPrediction::route('/{record}/edit'),
        ];
    }    
}
