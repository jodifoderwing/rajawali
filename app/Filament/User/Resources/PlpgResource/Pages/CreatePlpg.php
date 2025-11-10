<?php

namespace App\Filament\User\Resources\PlpgResource\Pages;

use App\Filament\User\Resources\PlpgResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePlpg extends CreateRecord
{
    protected static string $resource = PlpgResource::class;

    protected static bool $canCreateAnother = false;

    protected function afterCreate(): void
    {
        $this->dispatch('refreshComponent');
    }
}
