<?php

namespace App\Filament\User\Resources\SkkResource\Pages;

use App\Filament\User\Resources\SkkResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSkks extends ListRecords
{
    protected static string $resource = SkkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
