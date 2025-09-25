<?php

namespace App\Filament\Resources\PersilsgResource\Pages;

use App\Filament\Resources\PersilsgResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePersilsg extends CreateRecord
{
    protected static string $resource = PersilsgResource::class;

    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
