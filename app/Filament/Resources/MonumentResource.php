<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MonumentResource\Pages;
use App\Filament\Resources\MonumentResource\RelationManagers;
use App\Filament\Resources\MonumentResource\RelationManagers\ClassesRelationManager;
use App\Filament\Resources\MonumentResource\RelationManagers\TreatersRelationManager;
use App\Models\Monument;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Builder as WebcallBuilder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
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

    protected static ?string $navigationGroup = 'statues';

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        Card::make()
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
                                    ->mask(fn (TextInput\Mask $mask) => $mask->pattern('+{39} 0000 000 000'))
                                    ->tel(),

                                Select::make('municipality_code')
                                    ->searchable()
                                    ->relationship('municipality', 'name')
                                    ->required(),

                                FileUpload::make('monument_image')
                                    ->image()
                                    ->directory('images/monuments')
                                    ->required(),

                                Select::make('character_id')
                                    ->multiple()
                                    ->relationship('characters', 'name')
                            ])
                            ->columns(2),

                        Section::make('Webcall')
                            ->relationship('webcall')
                            ->schema([
                                WebcallBuilder::make('resources')
                                    ->blocks([
                                        WebcallBuilder\Block::make('audio')
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
                                            ])
                                            ->columns(2),
                                        WebcallBuilder\Block::make('link')
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
                            ])
                            ->collapsible(),

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
                                ->content(fn (Monument $record): ?string => $record->created_at?->diffForHumans()),

                            Placeholder::make('updated_at')
                                ->content(fn (Monument $record): ?string => $record->updated_at?->diffForHumans()),
                        ])
                        ->hidden(fn (?Monument $record) => $record === null),

                    Section::make('Status')
                        ->schema([
                            Select::make('category_id')
                                ->multiple()
                                ->relationship('categories', 'name'),

                            Toggle::make('visible')
                                ->helperText('This statue will be hidden.')
                                ->default(true),
                        ]),

                    Section::make('Map')
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
                                ->image()
                                ->directory('images/pins') ,
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
                BadgeColumn::make('phone_number')
                    ->copyable()
                    ->sortable(),
                IconColumn::make('visible')
                    ->sortable()
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),
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
