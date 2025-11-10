<?php

namespace App\Filament\User\Pages;

use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Forms;
use App\Models\Kalkel;
use App\Models\Kapkem;
use App\Models\Kabkota;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;

class PetaSebaran extends Page implements HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-map';
    protected static string $view = 'filament.user.pages.peta-sebaran';
    protected static ?string $title = 'Peta Tanah Kasultanan';
    protected static ?string $navigationGroup = 'PETA';
    protected static ?string $slug = 'peta-sebaran';

    public ?int $kalkel_id = null;
    public ?string $nama_kalurahan = null;

    public function mount(): void
    {
        $this->kalkel_id = request()->query('kalkel_id');
        if ($this->kalkel_id) {
            $kalurahan = Kalkel::find($this->kalkel_id);
            $this->nama_kalurahan = $kalurahan ? $kalurahan->nama : null;
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('mulai')
                ->label('Mulai')
                ->color('primary')
                ->icon('heroicon-o-arrow-path')
                ->tooltip('Klik untuk memulai')
                ->action(function () {
                    return redirect(request()->header('Referer') ?? route('filament.user.pages.peta-sebaran'));
                }),

            Action::make('pilihKalurahan')
                ->label('PILIH KALURAHAN')
                ->icon('heroicon-o-building-office-2')
                ->modalHeading('Pilih Lokasi Kalurahan')
                ->modalDescription('Pilih kabupaten, kecamatan, dan kalurahan untuk menampilkan peta')
                ->form([
                    Section::make('Filter Lokasi')
                        ->schema([
                            Select::make('kabkota_id')
                                ->label('Kabupaten/Kota')
                                ->placeholder('Pilih Kabupaten/Kota')
                                ->options(Kabkota::pluck('nama', 'id'))
                                ->searchable()
                                ->required()
                                ->reactive()
                                ->afterStateUpdated(fn(callable $set) => $set('kapkem_id', null)),

                            Select::make('kapkem_id')
                                ->label('Kecamatan')
                                ->placeholder('Pilih Kecamatan')
                                ->options(
                                    fn(callable $get) =>
                                    $get('kabkota_id') ? Kapkem::where('kabkota_id', $get('kabkota_id'))->pluck('nama', 'id') : []
                                )
                                ->searchable()
                                ->required()
                                ->reactive()
                                ->afterStateUpdated(fn(callable $set) => $set('kalkel_id', null)),

                            Select::make('kalkel_id')
                                ->label('Kalurahan')
                                ->placeholder('Pilih Kalurahan')
                                ->options(
                                    fn(callable $get) =>
                                    $get('kapkem_id') ? Kalkel::where('kapkem_id', $get('kapkem_id'))->pluck('nama', 'id') : []
                                )
                                ->searchable()
                                ->required(),
                        ])
                        ->columns(1)
                ])
                ->modalSubmitActionLabel('Tampilkan Peta')
                ->modalCancelActionLabel('Batal')
                ->action(function (array $data) {
                    if (!empty($data['kalkel_id'])) {
                        return redirect()->to(self::getUrl(['kalkel_id' => $data['kalkel_id']]));
                    }
                })
                ->closeModalByClickingAway(false),
        ];
    }
}
