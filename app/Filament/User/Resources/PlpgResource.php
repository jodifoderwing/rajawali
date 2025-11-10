<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\PlpgResource\Pages;
use App\Filament\User\Resources\PlpgResource\RelationManagers;
use App\Filament\User\Resources\PlpgResource\RelationManagers\PlpgwilayahRelationManager;
use App\Models\Plpg;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PlpgResource extends Resource
{
    protected static ?string $model = Plpg::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $activeNavigationIcon = 'heroicon-s-user-group';

    protected static ?string $navigationGroup = 'HUMAN RESOURCES';

    protected static ?string $slug = 'plpg';

    protected static ?string $label = 'Petugas Lapangan Pabrik Gula';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Data Petugas Lapangan Pabrik Gula')
                    ->schema([
                        Forms\Components\TextInput::make('nama')
                            ->label('NAMA PLPG')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('no_hp')
                            ->label('NO. HANDPHONE')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('jabatan')
                            ->label('JABATAN')
                            ->default('Petugas Lapangan Pabrik Gula')
                            ->maxLength(255),
                    ])->columns(3),

                Fieldset::make('Data SKK dan SKW')
                    ->schema([
                        Forms\Components\Select::make('skk_id')
                            ->label('NAMA SKK')
                            ->placeholder('--pilih Sinder Kebun Kepala--')
                            ->relationship('skk', 'nama')
                            ->required(),
                        Forms\Components\Select::make('skw_id')
                            ->label('NAMA SKW')
                            ->placeholder('--pilih Sinder Kebun Wilayah--')
                            ->relationship('skw', 'nama')
                            ->required(),
                    ])->columns(3),
            ])->inlineLabel();
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('NAMA')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jabatan')
                    ->label('JABATAN')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_hp')
                    ->label('NO. HANDPHONE')
                    ->searchable(),
                Tables\Columns\TextColumn::make('plpgwilayah.nama')
                    ->label('WILAYAH KERJA')
                    ->wrap()
                    ->badge(),
                Tables\Columns\TextColumn::make('skw.nama')
                    ->label('NAMA SKW')
                    ->sortable(),
                Tables\Columns\TextColumn::make('skk.nama')
                    ->label('NAMA SKK')
                    ->sortable(),
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
            PlpgwilayahRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlpgs::route('/'),
            'create' => Pages\CreatePlpg::route('/create'),
            'edit' => Pages\EditPlpg::route('/{record}/edit'),
        ];
    }
}
