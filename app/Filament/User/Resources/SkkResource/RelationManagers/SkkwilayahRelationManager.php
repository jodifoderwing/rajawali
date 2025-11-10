<?php

namespace App\Filament\User\Resources\SkkResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SkkwilayahRelationManager extends RelationManager
{
    protected static string $relationship = 'skkwilayah';

    protected static ?string $title = 'WILAYAH KERJA';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('WILAYAH KERJA SKK')
                    ->schema([
                        Forms\Components\TextInput::make('nama')
                            ->label('NAMA WILAYAH')
                            ->required()
                            ->maxLength(255),
                    ]),
            ])->inlineLabel();
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nama')
            ->recordUrl(function ($record) {
                return null;
            })
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('NAMA WILAYAH'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
