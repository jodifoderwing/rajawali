<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PersilResource\Pages;
use App\Filament\Resources\PersilResource\RelationManagers;
use App\Models\Persil;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PersilResource extends Resource
{
    protected static ?string $model = Persil::class;

    protected static ?string $navigationIcon = 'heroicon-c-swatch';

    protected static ?string $label = 'Data Tanah Kalurahan';

    protected static ?string $navigationGroup = 'Tata Kelola Tanah Kalurahan';

    protected static ?string $slug = 'tanah-kalurahan';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Letak Persil')
                    ->schema([
                        Forms\Components\TextInput::make('padkam_id')
                            ->required()
                            ->numeric(),
                    ]),
                Forms\Components\Section::make('Data Persil')
                    ->schema([
                        Forms\Components\TextInput::make('Nomor')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('klas')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('luas')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('jenis')
                            ->required()
                            ->maxLength(255),
                    ])->columns(2),
            ])->inlineLabel();
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('padkam_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('Nomor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('klas')
                    ->searchable(),
                Tables\Columns\TextColumn::make('luas')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jenis')
                    ->searchable(),
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
                Tables\Actions\ViewAction::make(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPersils::route('/'),
            'create' => Pages\CreatePersil::route('/create'),
            'view' => Pages\ViewPersil::route('/{record}'),
            'edit' => Pages\EditPersil::route('/{record}/edit'),
        ];
    }
}
