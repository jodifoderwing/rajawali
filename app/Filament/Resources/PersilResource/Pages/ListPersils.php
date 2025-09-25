<?php

namespace App\Filament\Resources\PersilResource\Pages;

use App\Filament\Resources\PersilResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPersils extends ListRecords
{
    protected static string $resource = PersilResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
