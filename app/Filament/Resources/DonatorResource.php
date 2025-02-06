<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Donator;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\DonatorResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DonatorResource\RelationManagers;

class DonatorResource extends Resource
{
    protected static ?string $model = Donator::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationGroup = 'Donations';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->label('Nama')
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->label('Email')
                    ->required()
                    ->maxLength(255),
                TextInput::make('phone')
                    ->tel()
                    ->label('No Telepon')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->label('Nama'),
                TextColumn::make('email')
                    ->searchable()
                    ->label('Email'),
                TextColumn::make('phone')
                    ->searchable()
                    ->label('No Telepon')
                    ->formatStateUsing(fn ($state) => '+62' . ltrim($state, '0')),
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
            'index' => Pages\ListDonators::route('/'),
            'create' => Pages\CreateDonator::route('/create'),
            // 'edit' => Pages\EditDonator::route('/{record}/edit'),
        ];
    }
}
