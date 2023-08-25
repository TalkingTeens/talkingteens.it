<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AuthorResource\Pages;
use App\Filament\Resources\AuthorResource\RelationManagers;
use App\Filament\Resources\AuthorResource\RelationManagers\MonumentsRelationManager;
use App\Models\Author;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Concerns\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class AuthorResource extends Resource
{
    use Translatable;

    protected static ?string $model = Author::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        Card::make()
                            ->schema([
                                TextInput::make('last_name')
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(fn (string $context, $state, callable $set) => $context === 'create' ? $set('slug', Str::slug($state)) : null),

                                TextInput::make('first_name')
                                    ->required(),

                                TextInput::make('slug')
                                    ->disabledOn('edit')
                                    ->required()
                                    ->helperText('Una volta impostato, questo campo non può essere più modificato.')
                                    ->unique(Author::class, 'slug', ignoreRecord: true),

                                FileUpload::make('picture')
                                    ->image()
                                    ->directory('images/authors')
                                    ->nullable(),
                            ])
                            ->columns(2),

                        RichEditor::make('description')
                            ->columnSpan(2)
                            ->required()
                            ->disableToolbarButtons([
                                'codeBlock',
                            ]),
                    ])
                    ->columnSpan(['lg' => 2]),

                Group::make()->schema([
                    Card::make()
                        ->schema([
                            Placeholder::make('created_at')
                                ->content(fn (Author $record): ?string => $record->created_at?->diffForHumans()),

                            Placeholder::make('updated_at')
                                ->content(fn (Author $record): ?string => $record->updated_at?->diffForHumans()),
                        ])
                        ->hidden(fn (?Author $record) => $record === null),

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
                ImageColumn::make('picture'),
                TextColumn::make('full_name')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListAuthors::route('/'),
            'create' => Pages\CreateAuthor::route('/create'),
            'view' => Pages\ViewAuthor::route('/{record}'),
            'edit' => Pages\EditAuthor::route('/{record}/edit'),
        ];
    }
}
