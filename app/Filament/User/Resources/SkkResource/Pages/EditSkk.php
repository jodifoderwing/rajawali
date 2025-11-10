<?php

namespace App\Filament\User\Resources\SkkResource\Pages;

use App\Filament\User\Resources\SkkResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSkk extends EditRecord
{
    protected static string $resource = SkkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
