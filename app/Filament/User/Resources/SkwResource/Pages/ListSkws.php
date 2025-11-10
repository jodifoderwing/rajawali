<?php

namespace App\Filament\User\Resources\SkwResource\Pages;

use App\Filament\User\Resources\SkwResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSkws extends ListRecords
{
    protected static string $resource = SkwResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
