<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MonumentResource\Pages;
use App\Filament\Resources\MonumentResource\RelationManagers\ClassesRelationManager;
use App\Models\Category;
use App\Models\Monument;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\Summarizers\Count;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class MonumentResource extends Resource
{
    use Translatable;

    protected static ?string $model = Monument::class;

    protected static ?string $navigationGroup = 'Statues';

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                TextInput::make('name')
                                    ->required()
                                    ->hint('Translatable')
                                    ->hintIcon('heroicon-o-language')
                                    ->reactive()
                                    ->afterStateUpdated(fn(string $context, $state, callable $set) => $context === 'create' ? $set('slug', Str::slug($state)) : null),

                                TextInput::make('slug')
                                    ->disabledOn('edit')
                                    ->required()
                                    ->helperText('Una volta impostato, questo campo non può essere più modificato.')
                                    ->unique(Monument::class, 'slug', ignoreRecord: true),

                                TextInput::make('phone_number')
                                    ->prefix('+39')
                                    ->mask('9999 999 9999')
                                    ->tel(),

                                Select::make('municipality_code')
                                    ->searchable()
                                    ->relationship('municipality', 'name')
                                    ->required(),

                                Select::make('author_id')
                                    ->searchable()
                                    ->multiple()
                                    ->relationship('authors', 'first_name'),

                                FileUpload::make('monument_image')
                                    ->image()
                                    ->directory('images/monuments')
                                    ->required(),

                                Select::make('character_id')
                                    ->searchable()
                                    ->multiple()
                                    ->relationship('characters', 'name')
//                                                    ->getOptionLabelFromRecordUsing(fn (Character $record) => $record->name)
//                                                    ->getSearchResultsUsing(fn (string $search): array => Character::where('name->it', 'like', "%{$search}%")->limit(50)->pluck('name', 'id')->toArray())
                            ])
                            ->columns(2)
                            ->columnSpan(2),

                        TextInput::make('latitude')
                            ->numeric()
                            /*->mask(fn (TextInput\Mask $mask) => $mask
                                ->numeric()
                                ->decimalSeparator(',')
                                ->decimalPlaces(6)
                                ->mapToDecimalSeparator(['.'])
                                ->minValue(-90)
                                ->maxValue(90)
                                ->padFractionalZeros()
                            )*/
                            ->required(),
                        TextInput::make('longitude')
                            ->numeric()
                            /*->mask(fn (TextInput\Mask $mask) => $mask
                                ->numeric()
                                ->decimalPlaces(6)
                                ->decimalSeparator(',')
                                ->mapToDecimalSeparator(['.'])
                                ->minValue(-180)
                                ->maxValue(180)
                                ->padFractionalZeros()
                            )*/
                            ->required(),

                        RichEditor::make('description')
                            ->columnSpan(2)
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
                                ->content(fn(Monument $record): ?string => $record->created_at?->diffForHumans()),

                            Placeholder::make('updated_at')
                                ->content(fn(Monument $record): ?string => $record->updated_at?->diffForHumans()),
                        ])
                        ->hidden(fn(?Monument $record) => $record === null),

                    Section::make('Status')
                        ->schema([
                            SpatieTagsInput::make('tags')
                                ->suggestions(Category::getWithType('category')->pluck('name'))
                                ->type('category'),
//                                    ->getOptionLabelFromRecordUsing(fn($record, $livewire) => $record->getTranslation('name', $livewire->activeLocale)),

                            Toggle::make('visible')
                                ->helperText('This statue will be hidden.')
                                ->default(true),
                        ]),
                ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('monument_image'),

                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('municipality.name')
                    ->sortable()
                    ->searchable(),

                SpatieMediaLibraryImageColumn::make('authors.picture')
                    ->collection('authors')
                    ->circular()
                    ->stacked()
                    ->limit(2)
                    ->limitedRemainingText(),

                IconColumn::make('visible')
                    ->summarize(Count::make()->icons())
                    ->boolean(),
            ])
            ->defaultGroup('municipality.name')
            ->filters([
                SelectFilter::make('municipality')
                    ->searchable()
                    ->relationship('municipality', 'name'),
                TernaryFilter::make('visible'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withoutGlobalScopes();
    }

    public static function getRelations(): array
    {
        return [
            ClassesRelationManager::class,
            // TreatersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMonuments::route('/'),
            'create' => Pages\CreateMonument::route('/create'),
            'edit' => Pages\EditMonument::route('/{record}/edit'),
        ];
    }
}
