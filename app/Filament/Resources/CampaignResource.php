<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Campaign;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CampaignResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CampaignResource\RelationManagers;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Support\Str;

class CampaignResource extends Resource
{
    protected static ?string $model = Campaign::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Campaign';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('judul')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, callable $set) {
                        $slug = Str::slug($state);
                        $set('slug', $slug);
                    }),
                TextInput::make('slug')
                    ->readOnly(),
                Textarea::make('deskripsi')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('target_donasi')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),
                DatePicker::make('deadline'),
                Select::make('status')
                    ->options([
                        'aktif' => 'Aktif',
                        'selesai' => 'selesai',
                    ])
                    ->default('aktif'),
                FileUpload::make('gambar')
                    ->columnSpanFull()
                    ->image()
                    ->directory('campaign'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('judul')
                    ->searchable(),
                TextColumn::make('target_donasi')
                    ->numeric()
                    ->sortable()
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                TextColumn::make('dana_terkumpul')
                    ->numeric()
                    ->sortable()
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                TextColumn::make('deadline')
                    ->date()
                    ->sortable(),
                ImageColumn::make('gambar')
                    ->columnSpanFull()
                    ->disk('public') 
                    ->url(fn ($record) => (asset('storage/' . $record->gambar))) 
                    ->size(70),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'aktif' => 'success',
                        'selesai' => 'danger',
                        default => 'secondary',
                    }),
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
                Tables\Actions\DeleteAction::make(),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCampaigns::route('/'),
            'create' => Pages\CreateCampaign::route('/create'),
            'edit' => Pages\EditCampaign::route('/{record}/edit'),
        ];
    }
}
