<?php

namespace App\Filament\User\Resources\UkurResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\Survey;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Forms\Components\Actions\Action;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class SurveydetailRelationManager extends RelationManager
{
    protected static string $relationship = 'surveyDetails';

    protected static ?string $label = 'Data Pengukuran Bidang Tanah';

    protected static ?string $title = 'DATA PENGUKURAN BIDANG TANAH';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Wizard::make([
                    Forms\Components\Wizard\Step::make('PENGUKURAN BIDANG')
                        ->schema([
                            Forms\Components\Section::make('SURVEY ORIENTASI LOKASI')
                                // ->aside()
                                ->schema([
                                    Forms\Components\TextInput::make('no_bidang')
                                        ->label('» No. Bidang')
                                        ->disabled(),
                                    Forms\Components\TextInput::make('nama')
                                        ->label('» Nama Pemohon')
                                        ->disabled(),
                                    Forms\Components\TextInput::make('alamat_tanah')
                                        ->label('» Alamat Letak Tanah')
                                        ->disabled(),
                                ])->compact(),
                            Forms\Components\Section::make('DATA HASIL PENGUKURAN')
                                // ->aside()
                                ->schema([
                                    Forms\Components\TextInput::make('npk')
                                        ->label('» Nomor Persil Kekancingan (NPK)')
                                        ->required()
                                        ->numeric(),
                                    Forms\Components\TextInput::make('koordinat')
                                        ->label('» Koordinat Bidang Tanah')
                                        ->required()
                                        ->maxLength(255),
                                    Forms\Components\TextInput::make('luas_ukur')
                                        ->label('» Luas Hasil Ukur')
                                        ->numeric()
                                        ->suffix('M²'),
                                    Forms\Components\FileUpload::make('upload_gu')
                                        ->label('» Upload Gambar Ukur (GU)')
                                        ->directory('gambar_ukur')
                                        ->acceptedFileTypes(['application/pdf'])
                                        ->openable()
                                        ->getUploadedFileNameForStorageUsing(
                                            function ($record) {
                                                // dd($record);
                                                $surveyId = $record->survey_id;
                                                $survey = Survey::where('id', $surveyId)->first();
                                                $namaKal = $survey->kalkel->nama;
                                                $namaFile = 'GU_' . str_pad($record->id, 5, '0', STR_PAD_LEFT) . '_' . $namaKal . '_' . $record->no_bidang;
                                                return $namaFile;
                                            }
                                        )
                                        ->removeUploadedFileButtonPosition('right')
                                        ->uploadButtonPosition('left')
                                        ->uploadingMessage('Uploading Berkas...'),
                                    Forms\Components\Actions::make([
                                        Forms\Components\Actions\Action::make('Peta-Google')
                                            ->url(function ($record) {
                                                return 'https://www.google.com/maps?q=' . $record->koordinat . '&z=12';
                                            })
                                            ->label('Lihat Peta Google')
                                            ->icon('heroicon-o-globe-alt')
                                            ->color('info')
                                            ->openUrlInNewTab() // Membuka di tab baru
                                            ->visible(fn($record) => $record && $record->koordinat),
                                    ]),
                                ])->compact()
                        ]),
                    // Lihat Data Survey
                    Forms\Components\Wizard\Step::make('LIHAT DATA SURVEY')
                        ->schema([
                            Forms\Components\Section::make('SURVEY ORIENTASI LOKASI')
                                // ->aside()
                                ->schema([
                                    Forms\Components\DatePicker::make('tgl_ukur')
                                        ->label('» Tanggal Survey')
                                        ->disabled(),
                                    Forms\Components\TextInput::make('no_bidang')
                                        ->label('» No. Bidang')
                                        ->disabled(),
                                    Forms\Components\TextInput::make('nama')
                                        ->label('» Nama Pemohon')
                                        ->disabled(),
                                    Forms\Components\TextInput::make('alamat_tanah')
                                        ->label('» Alamat Letak Tanah')
                                        ->disabled(),
                                    Forms\Components\TextInput::make('posisi.nama')
                                        ->label('» Posisi Letak Tanah')
                                        ->placeholder(fn($record) => $record?->posisi?->nama)
                                        ->disabled(),
                                ])->compact(),

                            Forms\Components\Section::make('SURVEY OBYEK & SUBYEK')
                                // ->aside()
                                ->schema([
                                    Forms\Components\TextInput::make('utuhseb.nama')
                                        ->label('» Bidang Tanah Dimohon')
                                        ->placeholder(fn($record) => $record?->utuhseb?->nama)
                                        ->disabled(),
                                    Forms\Components\TextInput::make('adabangunan.nama')
                                        ->label('» Bangunan')
                                        ->placeholder(fn($record) => $record?->adabangunan?->nama)
                                        ->disabled(),
                                    Forms\Components\TextInput::make('kondbangunan.nama')
                                        ->label('» Kondisi Bangunan')
                                        ->placeholder(fn($record) => $record?->kondbangunan?->nama)
                                        ->disabled(),
                                    Forms\Components\TextInput::make('penggunaan.nama')
                                        ->label('» Penggunaan')
                                        ->placeholder(fn($record) => $record?->penggunaan?->nama)
                                        ->disabled(),
                                    Forms\Components\TextInput::make('ket')
                                        ->label('» Keterangan')
                                        ->disabled(),
                                    Forms\Components\TextInput::make('pekerjaan')
                                        ->label('» Pekerjaan Pemohon')
                                        ->disabled(),
                                    Forms\Components\TextInput::make('umr.nama')
                                        ->label('» Penghasilan Pemohon')
                                        ->placeholder(fn($record) => $record?->umr?->nama)
                                        ->disabled(),
                                    Forms\Components\TextInput::make('abdi.nama')
                                        ->label('» Abdi Dalem')
                                        ->placeholder(fn($record) => $record?->abdi?->nama)
                                        ->disabled(),
                                ])->compact(),

                            Forms\Components\Section::make('UPLOAD FOTO')
                                // ->aside()
                                ->schema([
                                    Forms\Components\FileUpload::make('upload_fotolap')
                                        ->label('» Foto Situasi')
                                        ->multiple()
                                        // ->panelLayout('grid')
                                        ->deletable(false)
                                        // ->disk('public')
                                        // ->directory('foto_obyek')
                                        ->openable(),
                                ])->compact(),
                        ]),
                ])->columnSpanFull()->skippable()
                    ->nextAction(fn(Action $action): Action => $action->extraAttributes(['x-show' => 'false']))
                    ->previousAction(fn(Action $action): Action => $action->extraAttributes(['x-show' => 'false']))
            ])->inlineLabel();
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('no_bidang')
                    ->label('NO. BIDANG')
                    ->alignCenter()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama')
                    ->label('NAMA')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('alamat_tanah')
                    ->label('ALAMAT LETAK TANAH')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('penggunaan.nama')
                    ->label('PENGGUNAAN')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tgl_ukur')
                    ->label('TGL. SURVEY')
                    ->date('d F Y'),
                Tables\Columns\TextColumn::make('berkas.noberkas')
                    ->label('NO. BERKAS'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->modalWidth('7xl') // Gedein ukuran modal,
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ], position: ActionsPosition::BeforeColumns)
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
