<?php

namespace App\Filament\Resources\PersilResource\Pages;

use App\Filament\Resources\PersilResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPersil extends ViewRecord
{
    protected static string $resource = PersilResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
