<?php

namespace App\Filament\User\Resources;

use App\Models\Skw;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\User\Resources\SkwResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\User\Resources\SkwResource\RelationManagers;
use App\Filament\User\Resources\SkwResource\RelationManagers\SkwwilayahRelationManager;

class SkwResource extends Resource
{
    protected static ?string $model = Skw::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $activeNavigationIcon = 'heroicon-s-user-group';

    protected static ?string $navigationGroup = 'HUMAN RESOURCES';

    protected static ?string $slug = 'skw';

    protected static ?string $label = 'Sinder Kebun Wilayah';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('DATA SINDER KEBUN WILAYAH')
                    ->description('Data Sinder Kebun Wilayah Kerja Sama Operasional')
                    ->aside()
                    ->schema([
                        Forms\Components\TextInput::make('nama')
                            ->label('NAMA')
                            ->required(),
                        Forms\Components\TextInput::make('jabatan')
                            ->label('JABATAN')
                            ->default('Sinder Kebun Wilayah')
                            ->required(),
                        Forms\Components\TextInput::make('no_hp')
                            ->label('NO. HANDPHONE')
                            ->required(),
                    ])->compact(),
                Section::make('DATA SINDER KEBUN KEPALA')
                    ->description('Data Sinder Kebun Kepala sebagai Atasan')
                    ->aside()
                    ->schema([
                        Forms\Components\Select::make('skk_id')
                            ->placeholder('--Pilih Sinder Kebun Kepala--')
                            ->relationship('skk', 'nama')
                            ->label('SINDER KEBUN KEPALA')
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
                    ->label('NAMA')
                    ->searchable(),
                TextColumn::make('jabatan')
                    ->label('JABATAN')
                    ->searchable(),
                TextColumn::make('no_hp')
                    ->label('NO. HANDPHONE')
                    ->searchable(),
                TextColumn::make('skwwilayah.nama')
                    ->label('WILAYAH KERJA')
                    ->wrap()
                    ->badge(),
                TextColumn::make('skk.nama')
                    ->label('SINDER KEBUN KEPALA')
                    ->sortable(),
                // TextColumn::make('skwwilayah.skkwilayah.nama')
                //     ->label('WILAYAH SKK')
                //     ->wrap()
                //     ->badge(),
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
            SkwwilayahRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSkws::route('/'),
            'create' => Pages\CreateSkw::route('/create'),
            'edit' => Pages\EditSkw::route('/{record}/edit'),
        ];
    }
}
