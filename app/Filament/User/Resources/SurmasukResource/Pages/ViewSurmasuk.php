<?php

namespace App\Filament\User\Resources\SurmasukResource\Pages;

use Filament\Actions\Action;
use Filament\Infolists\Infolist;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\FontWeight;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\User\Resources\SurmasukResource;
use Filament\Infolists\Components\{Section, TextEntry, RepeatableEntry, Grid};

class ViewSurmasuk extends ViewRecord
{
    protected static string $resource = SurmasukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Action::make('Cetak Surat')
            //     ->url(fn() => route('cetak.surat', ['surmasuk' => $this->record->id]))
            //     ->openUrlInNewTab()
            //     ->icon('heroicon-o-printer'),

            Action::make('Kembali')
                ->url(fn() => route('filament.user.resources.surat-masuk.index'))
                ->icon('heroicon-o-arrow-left'),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('AGENDA SURAT MASUK')
                    ->aside() // Pindah ke samping kanan jika memungkinkan
                    ->compact() // Mengurangi padding
                    ->columns(2)
                    ->schema([
                        TextEntry::make('no_surmas')
                            ->label('NOMOR AGENDA')
                            ->icon('heroicon-o-identification')
                            ->weight(FontWeight::Bold),

                        TextEntry::make('tgl_surmas')
                            ->label('TANGGAL AGENDA')
                            ->icon('heroicon-o-calendar-days')
                            ->weight(FontWeight::Bold)
                            ->date('d-m-Y'),
                    ]),

                Section::make('TENTANG SURAT')
                    ->aside()
                    ->schema([
                        TextEntry::make('no_surat')
                            ->label('NOMOR SURAT')
                            ->weight(FontWeight::SemiBold)
                            ->color('primary')
                            ->icon('heroicon-m-chevron-double-right'),
                        TextEntry::make('tgl_surat')
                            ->label('TANGGAL SURAT')
                            ->weight(FontWeight::SemiBold)
                            ->date('d-m-Y')
                            ->color('primary')
                            ->icon('heroicon-m-chevron-double-right'),
                        TextEntry::make('nama_pengirim')
                            ->label('PENGIRIM')
                            ->weight(FontWeight::SemiBold)
                            ->color('primary')
                            ->icon('heroicon-m-chevron-double-right'),
                        TextEntry::make('perihal')
                            ->label('PERIHAL')
                            ->weight(FontWeight::SemiBold)
                            ->color('primary')
                            ->icon('heroicon-m-chevron-double-right'),
                        TextEntry::make('isi_ringkas')
                            ->label('Isi Ringkas')
                            ->columnSpanFull()
                            ->markdown(),
                    ])->inlineLabel(),

                Section::make('📤 Disposisi Pegawai')
                    ->description('Hasil tindak lanjut dari masing-masing pegawai yang ditugaskan.')
                    ->schema([
                        RepeatableEntry::make('disposisis')
                            ->label('Disposisi')
                            ->schema([
                                TextEntry::make('pegawai.nama')
                                    ->label('Nama Pegawai')
                                    ->icon('heroicon-o-user'),

                                TextEntry::make('catatan')
                                    ->label('Catatan Disposisi')
                                    ->icon('heroicon-o-pencil-square'),

                                TextEntry::make('status')
                                    ->label('Status')
                                    ->badge()
                                    ->color(fn($state) => match ($state) {
                                        'pending' => 'gray',
                                        'proses' => 'warning',
                                        'selesai' => 'success',
                                        default => 'secondary',
                                    }),

                                TextEntry::make('kesimpulan')
                                    ->label('Kesimpulan Pegawai')
                                    ->markdown(),
                            ])
                            ->columns(2)
                            ->columnSpanFull(),
                    ]),
            ])->inlineLabel();
    }
}
