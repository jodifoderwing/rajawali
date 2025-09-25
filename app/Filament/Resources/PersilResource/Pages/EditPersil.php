<?php

namespace App\Filament\Resources\PersilResource\Pages;

use App\Filament\Resources\PersilResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPersil extends EditRecord
{
    protected static string $resource = PersilResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
