<?php

namespace App\Filament\Resources\PersilResource\Pages;

use App\Filament\Resources\PersilResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePersil extends CreateRecord
{
    protected static string $resource = PersilResource::class;

    protected static bool $canCreateAnother = false;
}
