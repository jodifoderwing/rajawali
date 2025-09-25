<?php

namespace App\Filament\User\Resources\SurveyResource\Pages;

use Filament\Actions;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\User\Resources\SurveyResource;

class CreateSurvey extends CreateRecord
{
    protected static string $resource = SurveyResource::class;

    protected static bool $canCreateAnother = false;

    protected function mutateFormDataBeforeCreate(array $data): array
    {

        $data['user_id'] = Auth::user()->id;

        return $data;
    }

    protected function afterCreate(): void
    {
        $this->dispatch('refreshComponent');
    }
}
