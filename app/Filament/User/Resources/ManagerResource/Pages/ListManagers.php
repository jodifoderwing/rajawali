<?php

namespace App\Filament\User\Resources\ManagerResource\Pages;

use App\Filament\User\Resources\ManagerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListManagers extends ListRecords
{
    protected static string $resource = ManagerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
