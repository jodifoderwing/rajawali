<?php

namespace App\Filament\User\Resources;

use Filament\Forms;
use App\Models\Ukur;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Enums\ActionsPosition;
use App\Filament\User\Resources\UkurResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\User\Resources\UkurResource\RelationManagers;
use App\Filament\User\Resources\UkurResource\RelationManagers\SurveydetailRelationManager;

class UkurResource extends Resource
{
    protected static ?string $model = Ukur::class;

    protected static ?string $navigationIcon = 'akar-airplay-audio';

    protected static ?string $navigationGroup = 'Tanah Kasultanan';

    protected static ?string $slug = 'pengukuran';

    protected static ?string $navigationLabel = 'Pengukuran Bidang';

    protected static ?string $modelLabel = 'Pengukuran Bidang';

    protected static ?int $navigationSort = 8;

    public static function canCreate(): bool
    {
        return false;
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('LOKASI LETAK BIDANG TANAH')
                    // ->aside()
                    ->schema([
                        Forms\Components\TextInput::make('lokasi')
                            ->label('RT/RW')
                            ->placeholder(fn($record) => $record?->survey?->lokasi)
                            ->disabled(),
                        Forms\Components\TextInput::make('padkam_id')
                            ->label('PADUKUHAN')
                            ->placeholder(fn($record) => $record?->survey->padkam?->nama)
                            ->disabled(),
                        Forms\Components\TextInput::make('kalkel_id')
                            ->label('KALURAHAN')
                            ->placeholder(fn($record) => $record?->survey->kalkel?->nama)
                            ->disabled(),
                        Forms\Components\TextInput::make('kapkem_id')
                            ->label('KAPANEWON')
                            ->placeholder(fn($record) => $record?->survey->kapkem?->nama)
                            ->disabled(),
                        Forms\Components\TextInput::make('kabkota_id')
                            ->label('KABUPATEN')
                            ->placeholder(fn($record) => $record?->survey->kabkota?->nama)
                            ->disabled(),
                        Forms\Components\TextInput::make('name')
                            ->label('PETUGAS')
                            ->placeholder(fn($record) => $record?->survey?->user?->name)
                            ->disabled(),
                        Forms\Components\TextInput::make('qty')
                            ->label('JUMLAH')
                            ->suffix('BIDANG')
                            ->placeholder(fn($record) => $record?->survey?->qty)
                            ->disabled(),
                        Forms\Components\TextInput::make('npk')
                            ->label('NPK')
                            // ->placeholder(fn($record) => $record?->survey?->user?->name)
                            ->disabled(),
                        Forms\Components\TextInput::make('upload_ukur')
                            ->label('UPLOAD FILE DWG')
                            ->columnSpan(2)
                            // ->placeholder(fn($record) => $record?->survey?->user?->name)
                            ->disabled(),
                    ])->compact()->columns(5),
            ])->inlineLabel();
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('10s')
            // ->striped()
            ->recordUrl(function ($record) {
                return null;
            })
            ->columns([
                Tables\Columns\TextColumn::make('survey.lokasi')
                    ->label('LOKASI (RT/RW)')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('survey.padkam.nama')
                    ->label('PADUKUHAN')
                    ->searchable(),
                Tables\Columns\TextColumn::make('survey.kalkel.nama')
                    ->label('KALURAHAN')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('survey.kapkem.nama')
                    ->label('KAPANEWON')
                    ->sortable(),
                Tables\Columns\TextColumn::make('survey.kabkota.nama')
                    ->label('KABUPATEN')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('survey.user.name')
                    ->label('PETUGAS')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('survey.qty')
                    ->label('BIDANG')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('terkirim')
                    ->label('KETERANGAN'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->hiddenLabel(),
            ], position: ActionsPosition::BeforeColumns)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            SurveydetailRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUkurs::route('/'),
            'create' => Pages\CreateUkur::route('/create'),
            'edit' => Pages\EditUkur::route('/{record}/edit'),
        ];
    }
}
