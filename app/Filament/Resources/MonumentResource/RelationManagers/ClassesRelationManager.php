<?php

namespace App\Filament\Resources\MonumentResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\Concerns\Translatable;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ClassesRelationManager extends RelationManager
{
    use Translatable;

    protected static string $relationship = 'classes';

    protected static ?string $recordTitleAttribute = 'grade';

//    #[Reactive]
//    public ?string $activeLocale = null;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make([
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
                ])
                    ->columnSpanFull(),

                Select::make('school_miur_code')
                    ->required()
                    ->searchable(['miur_code', 'name', 'website'])
                    ->relationship('school', 'name'),

//                Select::make('teachers')
//                    ->multiple()
//                    ->relationship(titleAttribute: 'first_name')
//                    ->createOptionForm([
//                        Forms\Components\Grid::make()
//                            ->schema([
//                                Forms\Components\TextInput::make('first_name')
//                                    ->required(),
//                                Forms\Components\TextInput::make('last_name')
//                                    ->required(),
//                            ])
//                    ]),

//                Forms\Components\Fieldset::make('Statua')
//                    ->schema([
//                        Forms\Components\SpatieMediaLibraryFileUpload::make('photo')
//                            ->collection('classes')
//                            ->columnSpanFull()
//                            ->required()
//                            ->image()
//                            ->imageEditor(),
//
//                        Forms\Components\RichEditor::make('description')
//                            ->columnSpan(2)
//                            ->hint('Translatable')
//                            ->hintIcon('heroicon-o-language')
//                            ->disableToolbarButtons([
//                                'codeBlock',
//                            ]),
//                    ])
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
