<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Payment;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PaymentResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PaymentResource\RelationManagers;
use Filament\Tables\Columns\ImageColumn;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $navigationGroup = 'Donations';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('donation_id')
                    ->required()
                    ->numeric(),
                TextInput::make('bukti_transfer')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('donation.donator.name')
                    ->label('Nama Donator')
                    ->sortable(),
                TextColumn::make('donation.campaign.judul')
                    ->label('Nama Campaign')
                    ->sortable(),
                ImageColumn::make('bukti_transfer')
                    ->label('Bukti Transfer')
                    ->disk('public') 
                    ->url(fn ($record) => (asset('storage/' . $record->gambar)))
                    ->size(70),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    // public static function canCreate(): bool
    // {
    //     return false;
    // }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            // 'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }
}
