<?php

namespace App\Filament\User\Resources\SkwResource\Pages;

use App\Filament\User\Resources\SkwResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSkw extends CreateRecord
{
    protected static string $resource = SkwResource::class;

    protected static bool $canCreateAnother = false;

    protected function afterCreate(): void
    {
        $this->dispatch('refreshComponent');
    }
}
