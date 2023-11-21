<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MonumentResource\Pages;
use App\Filament\Resources\MonumentResource\RelationManagers;
use App\Filament\Resources\MonumentResource\RelationManagers\ClassesRelationManager;
use App\Filament\Resources\MonumentResource\RelationManagers\TreatersRelationManager;
use App\Models\Monument;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Builder as WebcallBuilder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Tabs;
use Filament\Resources\Concerns\Translatable;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
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
                Tabs::make('Heading')
                    ->tabs([
                        Tabs\Tab::make('Data')
                            ->schema([
                                Group::make()
                                    ->schema([
                                        Section::make()
                                            ->schema([
                                                TextInput::make('name')
                                                    ->required()
                                                    ->reactive()
                                                    ->afterStateUpdated(fn (string $context, $state, callable $set) => $context === 'create' ? $set('slug', Str::slug($state)) : null),

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
                                                    ->relationship('authors', 'full_name'),

                                                FileUpload::make('monument_image')
                                                    ->image()
                                                    ->directory('images/monuments')
                                                    ->required(),

                                                Select::make('character_id')
                                                    ->searchable()
                                                    ->multiple()
                                                    ->relationship('characters', 'name')
                                            ])
                                            ->columns(2),

                                        RichEditor::make('description')
                                            ->columnSpan(2)
                                            ->disableToolbarButtons([
                                                'codeBlock',
                                            ]),
                                    ])
                            ]),
                        Tabs\Tab::make('Map')
                            ->schema([
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
                                FileUpload::make('pin_image')
                                    ->nullable()
                                    ->columnSpan('full')
                                    ->image()
                                    ->directory('images/pins'),
                            ])->columns(2),
                        Tabs\Tab::make('Webcall')
                            ->schema([
                                FileUpload::make('background_image')
                                    ->nullable()
                                    ->columnSpan('full')
                                    ->image()
                                    ->directory('images/monuments/background'),
                                Group::make()
                                    ->relationship('webcall')
                                    ->schema([
                                        WebcallBuilder::make('resources')
                                            ->blocks([
                                                WebcallBuilder\Block::make('audio')->icon('heroicon-o-microphone')
                                                    ->schema([
                                                        Select::make('language')
                                                            ->options([
                                                                'it' => 'Italiano',
                                                                'en' => 'Inglese',
                                                                'pr' => 'Dialetto parmigiano',
                                                            ])
                                                            ->reactive()
                                                            ->required(),
                                                        FileUpload::make('resource')
                                                            ->directory('audio/webcalls')
                                                            ->required()
                                                            ->acceptedFileTypes(['audio/mpeg', 'audio/webm', 'audio/ogg', 'audio/wave', 'audio/wav']),
                                                        Select::make('voice_id')
                                                            ->multiple()
                                                            ->relationship('voices', 'full_name')
                                                            ->createOptionForm([
                                                                Forms\Components\Grid::make(2)
                                                                    ->schema([
                                                                        Forms\Components\TextInput::make('first_name')
                                                                            ->required(),
                                                                        Forms\Components\TextInput::make('last_name')
                                                                            ->required(),
                                                                    ])
                                                            ])
                                                    ])
                                                    ->columns(2),
                                                WebcallBuilder\Block::make('link')->icon('heroicon-o-link')
                                                    ->schema([
                                                        Select::make('language')
                                                            ->options([
                                                                'lis' => 'Lingua dei Segni Italiana',
                                                            ])
                                                            ->required(),

                                                        TextInput::make('resource')
                                                            ->url(),
                                                    ])
                                                    ->columns(2),
                                            ]),
                                    ]),
                            ]),
                    ])
                    ->columnSpan(['lg' => 2]),
                    Group::make()->schema([
                        Section::make()
                            ->schema([
                                Placeholder::make('created_at')
                                    ->content(fn (Monument $record): ?string => $record->created_at?->diffForHumans()),

                                Placeholder::make('updated_at')
                                    ->content(fn (Monument $record): ?string => $record->updated_at?->diffForHumans()),
                            ])
                            ->hidden(fn (?Monument $record) => $record === null),

                        Section::make('Status')
                            ->schema([
                                Select::make('category_id')
                                    ->searchable()
                                    ->multiple()
                                    ->relationship('categories', 'name'),

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
                TextColumn::make('phone_number')
                    ->copyable()
                    ->sortable(),
                IconColumn::make('visible')
                    ->sortable()
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),
            ])
            ->defaultGroup('municipality.name')
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

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withoutGlobalScopes();
    }

    public static function getRelations(): array
    {
        return [
            ClassesRelationManager::class,
            TreatersRelationManager::class,
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
