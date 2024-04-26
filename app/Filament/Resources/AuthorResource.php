<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AuthorResource\Pages;
use App\Filament\Resources\AuthorResource\RelationManagers\MonumentsRelationManager;
use App\Models\Author;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Concerns\Translatable;
use Illuminate\Support\Str;

class AuthorResource extends Resource
{
    use Translatable;

    protected static ?string $model = Author::class;

    protected static ?string $recordTitleAttribute = 'full_name';

    protected static ?string $navigationGroup = 'Statues';

    protected static ?string $navigationIcon = 'heroicon-o-paint-brush';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                TextInput::make('first_name')
                                    ->required(),

                                TextInput::make('last_name')
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(fn(string $context, $state, callable $set) => $context === 'create' ? $set('slug', Str::slug($state)) : null),

                                SpatieMediaLibraryFileUpload::make('picture')
                                    ->collection('authors')
                                    ->image()
                                    ->nullable(),

                                TextInput::make('slug')
                                    ->disabledOn('edit')
                                    ->required()
                                    ->helperText('Una volta impostato, questo campo non può essere più modificato.')
                                    ->unique(Author::class, 'slug', ignoreRecord: true),
                            ])
                            ->columns(2),

                        RichEditor::make('description')
                            ->columnSpan(2)
                            ->required()
                            ->hint('Translatable')
                            ->hintIcon('heroicon-o-language')
                            ->disableToolbarButtons([
                                'codeBlock',
                            ]),
                    ])
                    ->columnSpan(['lg' => 2]),

                Group::make()->schema([
                    Section::make()
                        ->schema([
                            Placeholder::make('created_at')
                                ->content(fn(Author $record): ?string => $record->created_at?->diffForHumans()),

                            Placeholder::make('updated_at')
                                ->content(fn(Author $record): ?string => $record->updated_at?->diffForHumans()),
                        ])
                        ->hidden(fn(?Author $record) => $record === null),

                    Section::make('Vita')
                        ->schema([
                            TextInput::make('birth_year')
                                ->required()
                                ->numeric(),

                            TextInput::make('death_year')
                                ->numeric(),
                        ])
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
                    ->collection('authors')
                    ->circular(),

                TextColumn::make('full_name')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListAuthors::route('/'),
            'create' => Pages\CreateAuthor::route('/create'),
            'edit' => Pages\EditAuthor::route('/{record}/edit'),
        ];
    }
}
