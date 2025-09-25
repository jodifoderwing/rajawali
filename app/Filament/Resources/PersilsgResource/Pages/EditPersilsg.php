<?php

namespace App\Filament\Resources\PersilsgResource\Pages;

use App\Filament\Resources\PersilsgResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPersilsg extends EditRecord
{
    protected static string $resource = PersilsgResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
