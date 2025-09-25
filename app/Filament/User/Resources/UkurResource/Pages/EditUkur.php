<?php

namespace App\Filament\User\Resources\UkurResource\Pages;

use App\Filament\User\Resources\UkurResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUkur extends EditRecord
{
    protected static string $resource = UkurResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
