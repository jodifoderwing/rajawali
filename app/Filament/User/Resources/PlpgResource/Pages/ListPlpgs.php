<?php

namespace App\Filament\User\Resources\PlpgResource\Pages;

use App\Filament\User\Resources\PlpgResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPlpgs extends ListRecords
{
    protected static string $resource = PlpgResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
