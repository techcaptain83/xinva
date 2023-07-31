<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Forms\Components\FileUpload;
use Filament\Tables;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('email')
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('gender')
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('total_credits')
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('credits_used')
                ->required()
                ->maxLength(255),
                // Forms\Components\TextInput::make('email_verified_at')
                // ->required()
                // ->maxLength(255),
                // Forms\Components\TextInput::make('password')
                // ->required()
                // ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('gender'),
                Tables\Columns\TextColumn::make('total_credits'),
                Tables\Columns\TextColumn::make('credits_used'),
                // Tables\Columns\TextColumn::make('email_verified_at'),
                // Tables\Columns\TextColumn::make('password'),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }    
}
