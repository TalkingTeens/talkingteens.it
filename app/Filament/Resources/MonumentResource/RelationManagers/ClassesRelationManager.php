<?php

namespace App\Filament\Resources\MonumentResource\RelationManagers;

use App\Models\Classe;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;

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
                    ->options([ //
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
                    ->placeholder('2023/24'),

                Select::make('teacher_id')
                    ->multiple()
                    ->relationship('teachers', 'full_name')
                    ->createOptionForm([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('first_name')
                                    ->required(),
                                Forms\Components\TextInput::make('last_name')
                                    ->required(),
                            ])
                    ]),

                Select::make('school_miur_code')
                    ->required()
                    ->searchable(['miur_code', 'name', 'website'])
                    ->relationship('school', 'name'),

                Forms\Components\FileUpload::make('photo')
                    ->image()
                    ->directory('images/classes'),

                RichEditor::make('description')
                    ->columnSpan(2)
                    ->hint('Translatable')
                    ->hintIcon('heroicon-o-language')
                    ->disableToolbarButtons([
                        'codeBlock',
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
//                Tables\Columns\ImageColumn::make('photo'),

                Tables\Columns\TextColumn::make('grade'),

                Tables\Columns\TextColumn::make('section'),

                Tables\Columns\TextColumn::make('discipline'),

                Tables\Columns\TextColumn::make('year'),

                Tables\Columns\TextColumn::make('school.type'),

                Tables\Columns\TextColumn::make('school.name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\AttachAction::make()
                    ->recordSelectSearchColumns(['grade', 'section', 'discipline'])
                    ->recordSelect(function (Select $select) {
                        return $select
                            ->multiple();
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\DetachBulkAction::make(),
            ]);
    }
}
