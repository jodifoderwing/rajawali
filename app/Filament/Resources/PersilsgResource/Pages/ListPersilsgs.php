<?php

namespace App\Filament\Resources\PersilsgResource\Pages;

use App\Filament\Resources\PersilsgResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPersilsgs extends ListRecords
{
    protected static string $resource = PersilsgResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
