<?php

namespace App\Filament\User\Resources\ManagerResource\Pages;

use App\Filament\User\Resources\ManagerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateManager extends CreateRecord
{
    protected static string $resource = ManagerResource::class;

    protected static bool $canCreateAnother = false;

    protected function afterCreate(): void
    {
        $this->dispatch('refreshComponent');
    }
}
