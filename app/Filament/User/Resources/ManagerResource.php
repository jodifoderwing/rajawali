<?php

namespace App\Filament\User\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Manager;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Enums\ActionsPosition;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\User\Resources\ManagerResource\Pages;
use App\Filament\User\Resources\ManagerResource\RelationManagers;

class ManagerResource extends Resource
{
    protected static ?string $model = Manager::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $activeNavigationIcon = 'heroicon-s-user';

    protected static ?string $navigationGroup = 'HUMAN RESOURCES';

    protected static ?string $slug = 'manager';

    protected static ?string $label = 'Manager';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('DATA MANAGER')
                    ->description('Data Manager Kerja Sama Operasional')
                    ->aside()
                    ->schema([
                        TextInput::make('nama')
                            ->label('NAMA')
                            ->required(),
                        TextInput::make('jabatan')
                            ->label('JABATAN')
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
                    ->sortable()
                    ->searchable(),
                TextColumn::make('no_hp')
                    ->label('NO. HANDPHONE')
                    ->sortable()
                    ->searchable(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListManagers::route('/'),
            'create' => Pages\CreateManager::route('/create'),
            'edit' => Pages\EditManager::route('/{record}/edit'),
        ];
    }
}
