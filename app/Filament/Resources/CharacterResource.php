<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CharacterResource\Pages;
use App\Filament\Resources\CharacterResource\RelationManagers;
use App\Models\Character;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Concerns\Translatable;
use Filament\Forms\Components\Placeholder;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CharacterResource extends Resource
{
    use Translatable;

    protected static ?string $model = Character::class;

    protected static ?string $navigationGroup = 'statues';

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        Card::make()
                            ->schema([
                                TextInput::make('name')
                                    ->required(),

                                TextInput::make('role'),

                                FileUpload::make('picture')
                                    ->image()
                                    ->directory('images/characters')
                                    ->nullable()
                                    ->disableLabel()
                                    ->columnSpan(2),
                            ])
                            ->columns(2),

                        RichEditor::make('description')
                            ->columnSpan(2)
                            ->disableToolbarButtons([
                                'codeBlock',
                            ]),
                    ])
                    ->columnSpan(['lg' => 2]),

                Group::make()->schema([
                    Card::make()
                        ->schema([
                            Placeholder::make('created_at')
                                ->content(fn (Character $record): ?string => $record->created_at?->diffForHumans()),

                            Placeholder::make('updated_at')
                                ->content(fn (Character $record): ?string => $record->updated_at?->diffForHumans()),
                        ])
                        ->hidden(fn (?Character $record) => $record === null),

                    Section::make('Vita')
                        ->schema([
                            TextInput::make('birth_year')
                                ->numeric()
                                ->minValue(0),

                            TextInput::make('death_year')
                                ->numeric()
                                ->minValue(0),
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
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('role')
                    ->sortable()
                    ->searchable(),
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
            //
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
