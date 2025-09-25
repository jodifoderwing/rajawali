<?php

namespace App\Filament\User\Resources;

use Filament\Forms;
use App\Models\Ukur;
use Filament\Tables;
use App\Models\Kalkel;
use App\Models\Kapkem;
use App\Models\Padkam;
use App\Models\Survey;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Actions\StaticAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Enums\ActionsPosition;
use RelationManagers\SsurveydetailRelationManager;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\User\Resources\SurveyResource\Pages;
use App\Filament\User\Resources\SurveyResource\RelationManagers;
use App\Filament\User\Resources\SurveyResource\RelationManagers\SurveydetailRelationManager;

class SurveyResource extends Resource
{
    protected static ?string $model = Survey::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $activeNavigationIcon = 'heroicon-s-truck';

    protected static ?string $navigationGroup = 'Tanah Kasultanan';

    protected static ?string $slug = 'survey';

    protected static ?string $navigationLabel = 'Survey Lapangan';

    protected static ?string $modelLabel = 'Survey Lapangan';

    protected static ?int $navigationSort = 7;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('LOKASI LETAK BIDANG TANAH')
                    // ->aside()
                    ->schema([
                        Forms\Components\Select::make('kabkota_id')
                            ->label('KABUPATEN')
                            ->relationship('kabkota', titleAttribute: 'nama')
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(function (Set $set) {
                                $set('kapkem_id', null);
                                $set('kalkel_id', null);
                                $set('padkam_id', null);
                            })
                            ->required(),
                        Forms\Components\Select::make('kapkem_id')
                            ->label('KAPANEWON')
                            ->options(fn(Get $get) => Kapkem::query()
                                ->where('kabkota_id', $get('kabkota_id'))
                                ->pluck('nama', 'id'))
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(function (Set $set) {
                                $set('kalkel_id', null);
                                $set('padkam_id', null);
                            })
                            ->required(),
                        Forms\Components\Select::make('kalkel_id')
                            ->label('KALURAHAN')
                            ->options(fn(Get $get) => Kalkel::query()
                                ->where('kapkem_id', $get('kapkem_id'))
                                ->pluck('nama', 'id'))
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(fn(Set $set) => $set('padkam_id', null))
                            ->required(),
                        Forms\Components\Select::make('padkam_id')
                            ->label('PADUKUHAN')
                            ->options(fn(Get $get) => Padkam::query()
                                ->where('kalkel_id', $get('kalkel_id'))
                                ->orderBy('nama')
                                ->pluck('nama', 'id'))
                            ->searchable()
                            ->preload()
                            ->live()
                            ->required(),
                        Forms\Components\TextInput::make('lokasi')
                            ->label('RT/RW')
                            ->required(),
                        Forms\Components\TextInput::make('user.name')
                            ->label('PETUGAS')
                            ->placeholder(fn($record) => $record?->user?->name)
                            ->disabled(),
                        Forms\Components\TextInput::make('qty')
                            ->label('JUMLAH')
                            ->suffix('BIDANG')
                            ->disabled(),
                        Forms\Components\Actions::make([
                            Forms\Components\Actions\Action::make('ukur_id')
                                ->action(function ($record) {
                                    $surveyId = $record->id;
                                    $ukur = Ukur::where('survey_id', $surveyId)->first();
                                    if (!$ukur) {
                                        Ukur::create([
                                            'survey_id' => $surveyId
                                        ]);
                                    }
                                })
                                ->icon('heroicon-m-power')
                                ->label('CONNECT TIM UKUR')
                                ->color('warning')
                                ->disabled(function ($record) {
                                    $id = $record?->id;
                                    $ukur = Ukur::where('survey_id', $id)->first();
                                    if ($ukur) {
                                        return true;
                                    }
                                }),
                        ]),
                    ])->compact()->columns(4),
            ])->inlineLabel();
    }

    public static function table(Table $table): Table
    {
        return $table

            ->poll('60s')
            ->recordUrl(function ($record) {
                return null;
            })

            ->columns([
                Tables\Columns\TextColumn::make('lokasi')
                    ->label('LOKASI (RT/RW)')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('padkam.nama')
                    ->label('PADUKUHAN')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kalkel.nama')
                    ->label('KALURAHAN')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('kapkem.nama')
                    ->label('KAPANEWON')
                    ->sortable(),
                Tables\Columns\TextColumn::make('kabkota.nama')
                    ->label('KABUPATEN')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('PETUGAS')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('qty')
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
            'index' => Pages\ListSurveys::route('/'),
            'create' => Pages\CreateSurvey::route('/create'),
            'edit' => Pages\EditSurvey::route('/{record}/edit'),
        ];
    }
}
