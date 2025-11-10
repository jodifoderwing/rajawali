<?php

namespace App\Filament\User\Resources\PlpgResource\Pages;

use App\Filament\User\Resources\PlpgResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPlpg extends EditRecord
{
    protected static string $resource = PlpgResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
