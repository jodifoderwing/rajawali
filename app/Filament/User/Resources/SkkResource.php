<?php

namespace App\Filament\User\Resources;

use App\Models\Skk;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Enums\ActionsPosition;
use App\Filament\User\Resources\SkkResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\User\Resources\SkkResource\RelationManagers;
use App\Filament\User\Resources\SkkResource\RelationManagers\SkkwilayahRelationManager;

class SkkResource extends Resource
{
    protected static ?string $model = Skk::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $activeNavigationIcon = 'heroicon-s-user-group';

    protected static ?string $navigationGroup = 'HUMAN RESOURCES';

    protected static ?string $slug = 'skk';

    protected static ?string $label = 'Sinder Kebun Kepala';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('DATA SINDER KEBUN KEPALA')
                    ->description('Data Sinder Kebun Kepala Kerja Sama Operasional')
                    ->aside()
                    ->schema([
                        TextInput::make('nama')
                            ->label('NAMA')
                            ->required(),
                        TextInput::make('jabatan')
                            ->label('JABATAN')
                            ->default('Sinder Kebun Kepala')
                            ->required(),
                        TextInput::make('no_hp')
                            ->label('NO. HANDPHONE')
                            ->required(),
                    ])->compact(),
            ])->inlineLabel();
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordUrl(function ($record) {
                return null;
            })
            ->columns([
                TextColumn::make('nama')
                    ->label('NAMA LENGKAP')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('jabatan')
                    ->label('JABATAN')
                    ->searchable(),
                TextColumn::make('no_hp')
                    ->label('NO. HANDPHONE')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('skkwilayah.nama')
                    ->label('WILAYAH')
                    ->wrap()
                    ->badge(),
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
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            SkkwilayahRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSkks::route('/'),
            'create' => Pages\CreateSkk::route('/create'),
            'edit' => Pages\EditSkk::route('/{record}/edit'),
        ];
    }
}
