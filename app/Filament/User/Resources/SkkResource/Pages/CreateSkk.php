<?php

namespace App\Filament\User\Resources\SkkResource\Pages;

use App\Filament\User\Resources\SkkResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSkk extends CreateRecord
{
    protected static string $resource = SkkResource::class;

    protected static bool $canCreateAnother = false;

    protected function afterCreate(): void
    {
        $this->dispatch('refreshComponent');
    }
}
