<?php

namespace App\Filament\User\Resources\SurveyResource\Pages;

use Filament\Actions;
use App\Models\Survey;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Components\Tab;
use Filament\Support\Enums\IconPosition;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\User\Resources\SurveyResource;

class ListSurveys extends ListRecords
{
    protected static string $resource = SurveyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        $user = Auth::user();
        $userId = $user->id;
        $role = $user->role;
        // dd($role);
        if ($role === 'ADMIN') {
            return [
                'The Projects' => Tab::make()
                    ->badge(Survey::query()->count())
                    // ->modifyQueryUsing(fn(Builder $query) => $query->where('user_id', $userId))
                    ->icon('akar-check-in')
                    ->iconPosition(IconPosition::After)
                    ->badgeColor('Emerald'),
            ];
        } else {
            return [
                'My Projects' => Tab::make()
                    ->badge(Survey::query()->where('user_id', $userId)->count())
                    ->modifyQueryUsing(fn(Builder $query) => $query->where('user_id', $userId))
                    ->icon('akar-check-in')
                    ->iconPosition(IconPosition::After)
                    ->badgeColor('Emerald'),
            ];
        }
    }
}
