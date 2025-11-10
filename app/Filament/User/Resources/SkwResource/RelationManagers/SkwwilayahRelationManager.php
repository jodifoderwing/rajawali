<?php

namespace App\Filament\User\Resources\SkwResource\RelationManagers;

use App\Models\Skkwilayah;
use App\Models\Skw;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Get;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class SkwwilayahRelationManager extends RelationManager
{
    protected static string $relationship = 'skwwilayah';

    protected static ?string $title = 'WILAYAH KERJA';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('WILAYAH KERJA')
                    ->description('Data Wilayah Kerja SKW')
                    ->aside()
                    ->schema([
                        Forms\Components\Select::make('skkwilayah_id')
                            ->label('WILAYAH SKK')
                            ->required()
                            ->placeholder('--Pilih Wilayah SKK')
                            ->options(
                                function (Get $get) {
                                    $skkId = $this->ownerRecord->skk_id;
                                    // dd($skkId);
                                    return Skkwilayah::where('skk_id', $skkId)->pluck('nama', 'id');
                                }

                            )
                            ->searchable()
                            ->required(),
                        // ->reactive()
                        // ->afterStateUpdated(fn(callable $set) => $set('kalkel_id', null)),
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
            ->recordUrl(function ($record) {
                return null;
            })
            ->recordTitleAttribute('nama')
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('NAMA WILAYAH SKW'),
                Tables\Columns\TextColumn::make('skkwilayah.nama')
                    ->label('NAMA WILAYAH SKK'),
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
