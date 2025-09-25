<?php

namespace App\Filament\User\Resources\SurveyResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Actions\StaticAction;
use Filament\Support\Enums\Alignment;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Enums\ActionsPosition;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class SurveydetailRelationManager extends RelationManager
{
    protected static string $relationship = 'surveyDetails';

    protected static ?string $title = 'SURVEY DETAIL BIDANG';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('SURVEY ORIENTASI LOKASI')
                    // ->aside()
                    ->schema([
                        Forms\Components\DatePicker::make('tgl_ukur')
                            ->label('» Tanggal Survey')
                            ->required()
                            ->default(now())
                            ->disabled()
                            ->dehydrated(false), // biar tidak dikirim ke backend
                        Forms\Components\TextInput::make('no_bidang')
                            ->label('» Nomor Bidang')
                            ->required(),
                        Forms\Components\TextInput::make('nama')
                            ->label('» Nama Pemohon')
                            ->required(),
                        Forms\Components\TextInput::make('alamat_tanah')
                            ->label('» Alamat Letak Tanah')
                            ->required(),
                        Forms\Components\Select::make('posisi_id')
                            ->relationship('posisi', titleAttribute: 'nama')
                            ->label('» Posisi Letak Tanah')
                            ->required(),
                    ])->compact(),

                Forms\Components\Section::make('SURVEY OBYEK & SUBYEK')
                    // ->aside()
                    ->schema([
                        Forms\Components\Radio::make('utuhseb_id')
                            ->label('» Bidang Tanah Dimohon')
                            ->options(fn() => \App\Models\Utuhseb::orderBy('id')->pluck('nama', 'id')->toArray())
                            ->inline()
                            ->required(),
                        Forms\Components\Radio::make('adabangunan_id')
                            ->label('» Bangunan')
                            ->options(fn() => \App\Models\Adabangunan::orderBy('id')->pluck('nama', 'id')->toArray())
                            ->inline()
                            ->required(),
                        Forms\Components\Select::make('kondbangunan_id')
                            ->label('» Kondisi Bangunan')
                            ->relationship(
                                name: 'kondbangunan',
                                titleAttribute: 'nama',
                                modifyQueryUsing: fn($query) => $query->orderBy('id')
                            )
                            ->required(),
                        Forms\Components\Select::make('penggunaan_id')
                            ->label('» Penggunaan')
                            ->relationship(
                                name: 'penggunaan',
                                titleAttribute: 'nama',
                                modifyQueryUsing: fn($query) => $query->orderBy('id')
                            )
                            ->createOptionForm([
                                Forms\Components\TextInput::make('nama')
                                    ->label('Penggunaan')
                                    ->required(),
                            ])
                            ->createOptionAction(function (Forms\Components\Actions\Action $action) {
                                return $action
                                    ->modalHeading('Tambah Data Penggunaan')
                                    ->modalWidth('3xl');
                            })
                            ->required(),
                        Forms\Components\TextInput::make('ket')
                            ->label('» Keterangan')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('pekerjaan')
                            ->label('» Pekerjaan Pemohon')
                            ->required(),
                        Forms\Components\Radio::make('umr_id')
                            ->label('» Penghasilan Pemohon')
                            ->options(fn() => \App\Models\umr::orderBy('id')->pluck('nama', 'id')->toArray())
                            ->inline()
                            ->required(),
                        Forms\Components\Radio::make('abdi_id')
                            ->label('» Abdi Dalem')
                            ->options(fn() => \App\Models\Abdi::orderBy('id')->pluck('nama', 'id')->toArray())
                            ->inline()
                            ->required(),
                    ])->compact(),

                Forms\Components\Section::make('UPLOAD FOTO')
                    // ->aside()
                    ->schema([
                        Forms\Components\FileUpload::make('upload_fotolap')
                            ->label('» Foto Situasi')
                            ->multiple()
                            ->panelLayout('grid')
                            // ->deletable(false)
                            ->disk('public')
                            ->directory('foto_obyek')
                            ->openable(),
                    ])->compact(),

            ])->inlineLabel();
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('no_bidang')
                    ->label('NO. BIDANG')
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
                    // ->modalWidth('7xl')
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['tgl_ukur'] = now();
                        return $data;
                    })
                    ->after(function (StaticAction $action, $livewire) {
                        $livewire->dispatch('refreshForm'); //Cek di EditSurvey.php #[On('refreshForm')]
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ], position: ActionsPosition::BeforeColumns)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
