<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CharacterResource\Pages;
use App\Filament\Resources\CharacterResource\RelationManagers\MonumentsRelationManager;
use App\Models\Character;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CharacterResource extends Resource
{
    use Translatable;

    protected static ?string $model = Character::class;

    protected static ?string $navigationGroup = 'Statues';

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('picture')
                            ->columnSpanFull()
                            ->collection('characters')
                            ->image()
                            ->avatar()
                            ->imageEditor()
                            ->circleCropper()
                            ->nullable(),

                        TextInput::make('name')
                            ->required()
                            ->columnSpanFull()
                            ->hint('Translatable')
                            ->hintIcon('heroicon-o-language'),

                        TextInput::make('birth_year')
                            ->numeric()
                            ->minValue(0),

                        TextInput::make('death_year')
                            ->numeric()
                            ->minValue(0),

                        RichEditor::make('description')
                            ->columnSpanFull()
                            ->hint('Translatable')
                            ->hintIcon('heroicon-o-language')
                            ->disableToolbarButtons([
                                'codeBlock',
                            ]),
                    ])
                    ->columns()
                    ->columnSpan(['lg' => 2]),


                Group::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                Placeholder::make('created_at')
                                    ->content(fn(Character $record): ?string => $record->created_at?->diffForHumans()),

                                Placeholder::make('updated_at')
                                    ->content(fn(Character $record): ?string => $record->updated_at?->diffForHumans()),
                            ])
                            ->hidden(fn(?Character $record) => $record === null),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('picture')
                    ->collection('characters')
                    ->circular(),

                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),

                SpatieMediaLibraryImageColumn::make('monuments.monument_image')
                    ->collection('monuments')
                    ->limit()
                    ->limitedRemainingText(isSeparate: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            MonumentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCharacters::route('/'),
            'create' => Pages\CreateCharacter::route('/create'),
            'edit' => Pages\EditCharacter::route('/{record}/edit'),
        ];
    }
}
