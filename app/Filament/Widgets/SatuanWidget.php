<?php

namespace App\Filament\Widgets;

use App\Models\Berkas;
use App\Models\Layangukur;
use App\Models\Pegawai;
use App\Models\Shmsg;
use App\Models\Surmasuk;
use App\Models\User;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SatuanWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Users Registered', User::count())
                ->description('All users that have joined')
                ->descriptionIcon('heroicon-m-user', IconPosition::Before)
                // ->chart([1, 2, 4, 8, 10, 20])
                ->color('success'),
        ];
    }
}
