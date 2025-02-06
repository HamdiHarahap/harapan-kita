<?php

namespace App\Filament\Resources\DonatorResource\Pages;

use App\Filament\Resources\DonatorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDonator extends EditRecord
{
    protected static string $resource = DonatorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
