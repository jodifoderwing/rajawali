<?php

namespace App\Filament\User\Resources\SkwResource\Pages;

use App\Filament\User\Resources\SkwResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSkw extends EditRecord
{
    protected static string $resource = SkwResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
