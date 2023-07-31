<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Filament\Resources\PaymentResource\RelationManagers;
use App\Models\Payment;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_id')
                ->required()
                ->maxLength(255),
                // Forms\Components\TextInput::make('stripe_id')
                // ->required()
                // ->maxLength(255),
                // Forms\Components\TextInput::make('paddle_subscription_id')
                // ->required()
                // ->maxLength(255),
                Forms\Components\TextInput::make('amount_subtotal')
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('amount_total')
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('currency')
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('payment_status')
                ->required()
                ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_id'),
                // Tables\Columns\TextColumn::make('stripe_id'),
                // Tables\Columns\TextColumn::make('stripe_price_id'),
                Tables\Columns\TextColumn::make('amount_subtotal'),
                Tables\Columns\TextColumn::make('amount_total'),
                Tables\Columns\TextColumn::make('currency'),
                Tables\Columns\TextColumn::make('payment_status'),

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
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }
}
