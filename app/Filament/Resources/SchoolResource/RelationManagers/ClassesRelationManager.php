<?php

namespace App\Filament\Resources\SchoolResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ClassesRelationManager extends RelationManager
{
    protected static string $relationship = 'classes';

    protected static ?string $recordTitleAttribute = 'grade';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('grade')
                    ->required()
                    ->options([
                        1 => '1',
                        2 => '2',
                        3 => '3',
                        4 => '4',
                        5 => '5',
                    ]),

                TextInput::make('section')
                    ->length(1)
                    ->nullable(),

                TextInput::make('discipline')
                    ->nullable(),

                TextInput::make('year')
                    ->length(7)
                    ->required()
                    ->placeholder('2023/24'),

                Select::make('teachers')
                    ->multiple()
                    ->relationship(titleAttribute: 'first_name')
                    ->createOptionForm([
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\TextInput::make('first_name')
                                    ->required(),
                                Forms\Components\TextInput::make('last_name')
                                    ->required(),
                            ])
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('grade'),

                Tables\Columns\TextColumn::make('section'),

                Tables\Columns\TextColumn::make('discipline'),

                Tables\Columns\TextColumn::make('year'),
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
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
