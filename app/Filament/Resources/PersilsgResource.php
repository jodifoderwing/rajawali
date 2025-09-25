<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Kalkel;
use App\Models\Kapkem;
use App\Models\Padkam;
use App\Models\Kabkota;
use Filament\Forms\Get;
use Filament\Forms\Set;
use App\Models\Persilsg;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Collection;
use Filament\Forms\Components\Grid;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Enums\ActionsPosition;
use App\Filament\Resources\PersilsgResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PersilsgResource\RelationManagers;

class PersilsgResource extends Resource
{
    protected static ?string $model = Persilsg::class;

    protected static ?string $navigationIcon = 'heroicon-m-rectangle-group';

    protected static ?string $label = 'Data Tanah Kasultanan';

    protected static ?string $navigationGroup = 'Tata Kelola Tanah Kasultanan';

    protected static ?string $slug = 'tanah-kasultanan';

    protected static ?int $navigationSort = 1;



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('WILAYAH ADMINISTRASI')
                    ->description('Letak Obyek Tanah Kasultanan')
                    ->aside()
                    ->schema([
                        Select::make('kabkota_id')
                            ->relationship('kabkota', titleAttribute: 'nama')
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(function (Set $set) {
                                $set('kapkem_id', null);
                                $set('kalkel_id', null);
                            })
                            ->label('KABUPATEN / KOTA')
                            ->required(),
                        Select::make('kapkem_id')
                            // ->options(fn(Get $get): Collection => Kapkem::query()
                            //     ->where('kabkota_id', $get('kabkota_id'))
                            //     ->pluck('nama', 'id'))
                            ->options(function (Forms\Get $get) {
                                return Kapkem::where('kabkota_id', $get('kabkota_id'))->pluck('nama', 'id');
                            })
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(fn(Set $set) => $set('kalkel_id', null))
                            ->label('KAPANEWON / KEMANTREN')
                            ->required(),
                        Select::make('kalkel_id')
                            // ->options(fn(Get $get): Collection => Kalkel::query()
                            //     ->where('kapkem_id', $get('kapkem_id'))
                            //     ->pluck('nama', 'id'))
                            ->options(function (Forms\Get $get) {
                                return Kalkel::where('kapkem_id', $get('kapkem_id'))->pluck('nama', 'id');
                            })
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(fn(Set $set) => $set('padkam_id', null))
                            ->label('KALURAHAN / KELURAHAN')
                            ->required(),
                        Select::make('padkam_id')
                            // ->options(fn(Get $get): Collection => Padkam::query()
                            //     ->where('kalkel_id', $get('kalkel_id'))
                            //     ->pluck('nama', 'id'))
                            ->options(function (Forms\Get $get) {
                                return Padkam::where('kalkel_id', $get('kalkel_id'))->pluck('nama', 'id');
                            })
                            ->searchable()
                            ->preload()
                            ->live()
                            ->label('PADUKUHAN / KAMPUNG')
                            ->required(),
                    ])->compact(),

                Section::make('OBYEK TANAH KASULTANAN')
                    ->description('Data Yuridis Hubungan Hukum Tanah Kasultanan')
                    ->aside()
                    ->schema([
                        TextInput::make('no')
                            ->label('NOMOR PERSIL')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('luas')
                            ->label('LUAS (M2)')
                            ->required()
                            ->numeric(),
                        TextInput::make('koordinat')
                            ->label('KOORDINAT LETAK BIDANG TANAH')
                            ->required(),
                        Select::make('jenis')
                            ->required()
                            ->label('JENIS PENGGUNAAN')
                            ->options([
                                'Pertanian' => 'Pertanian',
                                'Non Pertanian' => 'Non Pertanian'
                            ]),
                        TextInput::make('ket')
                            ->required()
                            ->label('KETERANGAN')
                            ->maxLength(255),
                    ])->compact(),


            ])->inlineLabel();
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no')
                    ->label('PERSIL')
                    ->searchable(),
                TextColumn::make('luas')
                    ->label('LUAS (M2)')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('jenis')
                    ->label('JENIS PENGGUNAAN')
                    ->sortable(),
                TextColumn::make('padkam.nama')
                    ->searchable()
                    ->label('PAD/KAMPUNG'),
                TextColumn::make('kalkel.nama')
                    ->sortable()
                    ->label('KAL/KELURAHAN'),
                TextColumn::make('kapkem.nama')
                    ->sortable()
                    ->label('KAP/KEMANTREN'),
                TextColumn::make('kabkota.nama')
                    ->sortable()
                    ->label('KAB/KOTA'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('Kabkota')
                    ->relationship('kabkota', 'nama')
                    ->label('Filter by Kabupaten')
                    ->indicator('Kabupaten')
                    ->attribute('kabkota_id'),
                SelectFilter::make('Kapkem')
                    ->relationship('kapkem', 'nama')
                    ->label('Filter by Kapanewon')
                    ->indicator('Kapanewon'),
                SelectFilter::make('Kalkel')
                    ->relationship('kalkel', 'nama')
                    ->searchable()
                    ->preload()
                    ->label('Filter by Kalurahan')
                    ->indicator('Kalurahan'),

            ], layout: FiltersLayout::Modal)
            ->deferFilters()
            ->persistFiltersInSession()->filtersTriggerAction(
                fn(Action $action) => $action
                    ->button()
                    ->label('Filter'),
            )


            ->actions([
                Tables\Actions\EditAction::make(),
            ], position: ActionsPosition::BeforeColumns)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->defaultSort('id', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPersilsgs::route('/'),
            'create' => Pages\CreatePersilsg::route('/create'),
            'edit' => Pages\EditPersilsg::route('/{record}/edit'),
        ];
    }
}
