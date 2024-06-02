<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MonumentResource\Pages;
use App\Filament\Resources\MonumentResource\RelationManagers;
use App\Models\Category;
use App\Models\Monument;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
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
                                    ->afterStateUpdated(fn(
                                        string $context,
                                        $state,
                                        callable $set
                                    ) => $context === 'create' ? $set('slug', Str::slug($state)) : null),

                                TextInput::make('slug')
                                    ->disabledOn('edit')
                                    ->required()
                                    ->helperText('Una volta impostato, questo campo non può essere più modificato.')
                                    ->unique(Monument::class, 'slug', ignoreRecord: true),

                                SpatieMediaLibraryFileUpload::make('monument_image')
                                    ->collection('monuments')
                                    ->columnSpanFull()
                                    ->required()
                                    ->image()
                                    ->imageEditor(),

                                TextInput::make('phone_number')
                                    ->prefix('+39')
                                    ->mask('9999 999 9999')
                                    ->tel(),

                                SpatieTagsInput::make('tags')
                                    ->suggestions(Category::getWithType('category')->pluck('name'))
                                    ->type('category'),
//                                    ->getOptionLabelFromRecordUsing(fn($record, $livewire) => $record->getTranslation('name', $livewire->activeLocale)),
                            ])
                            ->columns()
                            ->columnSpanFull(),

                        Section::make('Map')
                            ->schema([
                                Select::make('municipality')
                                    ->searchable()
                                    ->relationship(titleAttribute: 'name')
                                    ->required(),

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

                                SpatieMediaLibraryFileUpload::make('photo')
                                    ->collection('map')
                                    ->columnSpanFull()
                                    ->required()
                                    ->image()
                                    ->imageEditor(),
                            ])
                            ->columns(3),

                        Section::make()
                            ->schema([
                                Select::make('authors')
                                    ->multiple()
                                    ->searchable(['first_name', 'last_name'])
                                    ->relationship(titleAttribute: 'first_name'),

                                Select::make('characters')
                                    ->searchable()
                                    ->multiple()
                                    ->relationship(titleAttribute: 'name'),
//                                                    ->getOptionLabelFromRecordUsing(fn (Character $record) => $record->name)
//                                                    ->getSearchResultsUsing(fn (string $search): array => Character::where('name->it', 'like', "%{$search}%")->limit(50)->pluck('name', 'id')->toArray())

                                RichEditor::make('description')
                                    ->columnSpanFull()
                                    ->hint('Translatable')
                                    ->hintIcon('heroicon-o-language')
                                    ->disableToolbarButtons([
                                        'codeBlock',
                                    ]),
                            ])
                            ->columns()
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
                SpatieMediaLibraryImageColumn::make('monument_image')
                    ->collection('monuments'),

                TextColumn::make('name'),
//                    ->searchable() // TODO:

                TextColumn::make('municipality.name')
                    ->sortable(),

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
            RelationManagers\ClassesRelationManager::class,
            RelationManagers\TreatersRelationManager::class,
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
