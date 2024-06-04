<?php

namespace App\Filament\Resources\MonumentResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class TreatersRelationManager extends RelationManager
{
    protected static string $relationship = 'treaters';

    protected static ?string $recordTitleAttribute = 'first_name';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('last_name')
                    ->required()
                    ->maxLength(255),

                /*
                Fieldset::make('Statua')
                    ->schema([
                        Forms\Components\SpatieMediaLibraryFileUpload::make('photo')
                            ->collection('classes')
                            ->columnSpanFull()
                            ->required()
                            ->image()
                            ->imageEditor(),

                        RichEditor::make('description')
                            ->columnSpan(2)
                            ->hint('Translatable')
                            ->hintIcon('heroicon-o-language')
                            ->disableToolbarButtons([
                                'codeBlock',
                            ]),
                    ])
                */
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\ImageColumn::make('photo'),

                Tables\Columns\TextColumn::make('last_name'),

                Tables\Columns\TextColumn::make('first_name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\AttachAction::make(),
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
