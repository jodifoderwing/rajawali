<?php

namespace App\Filament\User\Resources\PlpgResource\RelationManagers;

use App\Models\Skwwilayah;
use App\Models\Plpg;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class PlpgwilayahRelationManager extends RelationManager
{
    protected static string $relationship = 'plpgwilayah';

    protected static ?string $title = 'WILAYAH KERJA';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('WILAYAH KERJA')
                    ->description('Data Wilayah Kerja PLPG')
                    ->aside()
                    ->schema([
                        Forms\Components\Select::make('skwwilayah_id')
                            ->label('WILAYAH SKW')
                            ->required()
                            ->placeholder('--Pilih Wilayah SKW')
                            ->options(
                                function () {
                                    $skwId = $this->ownerRecord->skw_id;
                                    // dd($skkId);
                                    return Skwwilayah::where('skw_id', $skwId)->pluck('nama', 'id');
                                }

                            )
                            ->searchable()
                            ->required(),
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
                    ->label('WILAYAH PLPG'),
                Tables\Columns\TextColumn::make('skwwilayah.nama')
                    ->label('WILAYAH SKW'),
                Tables\Columns\TextColumn::make('skwwilayah.skkwilayah.nama')
                    ->label('WILAYAH SKK'),
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
