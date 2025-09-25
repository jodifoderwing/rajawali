<?php

namespace App\Filament\User\Resources\UkurResource\Pages;

use App\Filament\User\Resources\UkurResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUkurs extends ListRecords
{
    protected static string $resource = UkurResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
