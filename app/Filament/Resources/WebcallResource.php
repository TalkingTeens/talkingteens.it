<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WebcallResource\Pages;
use App\Filament\Resources\WebcallResource\RelationManagers;
use App\Models\Webcall;
use Filament\Forms;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Summarizers\Average;
use Filament\Tables\Columns\Summarizers\Range;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class WebcallResource extends Resource
{
    protected static ?string $model = Webcall::class;

    protected static ?string $navigationGroup = 'Statues';

    protected static ?string $navigationIcon = 'heroicon-o-phone';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                Select::make('monument_id')
                                    ->searchable()
                                    ->relationship(name: 'monument', titleAttribute: 'name')
//                                    ->unique(ignoreRecord: true)
                                    ->required(),

                                SpatieMediaLibraryFileUpload::make('background')
                                    ->collection('webcalls')
                                    ->image()
                                    ->imageEditor()
                                    ->imageEditorAspectRatios([
                                        '9:16',
                                        '3:4',
                                    ])
                                    ->required(),
                            ]),

                        Section::make('Resources')
                            ->schema([
                                Builder::make('resources')
                                    ->blocks([
                                        Builder\Block::make('audio')
                                            ->icon('heroicon-o-microphone')
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
                                                    ->acceptedFileTypes([
                                                        'audio/mpeg', 'audio/webm', 'audio/ogg', 'audio/wave',
                                                        'audio/wav'
                                                    ]),

                                                Select::make('voices')
                                                    ->searchable()
                                                    ->multiple()
                                                    ->relationship(titleAttribute: 'last_name')
                                                    ->createOptionForm([
                                                        Forms\Components\Grid::make(2)
                                                            ->schema([
                                                                Forms\Components\TextInput::make('first_name')
                                                                    ->required(),

                                                                Forms\Components\TextInput::make('last_name')
                                                                    ->required(),
                                                            ])
                                                    ]),
                                            ])
                                            ->columns(),

                                        Builder\Block::make('link')->icon('heroicon-o-link')
                                            ->schema([
                                                Select::make('language')
                                                    ->options([
                                                        'lis' => 'Lingua dei Segni Italiana',
                                                    ])
                                                    ->required(),

                                                TextInput::make('resource')
                                                    ->activeUrl()
                                                    ->placeholder('https://...')
                                                    ->suffixIcon('heroicon-o-globe-alt'),
                                            ])
                                            ->columns(),
                                    ])
                                    ->hiddenLabel()
                                    ->minItems(1),
                            ])
                    ])
                    ->columnSpan(['lg' => 2]),

                Group::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                Placeholder::make('created_at')
                                    ->content(fn(Webcall $record): ?string => $record->created_at?->diffForHumans()),

                                Placeholder::make('updated_at')
                                    ->content(fn(Webcall $record): ?string => $record->updated_at?->diffForHumans()),
                            ])
                            ->hidden(fn(?Webcall $record) => $record === null),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('monument.name')
                    ->searchable(),

                TextColumn::make('started')
                    ->sortable()
                    ->numeric()
                    ->summarize([
                        Sum::make(),
                        Range::make(),
                    ]),

                TextColumn::make('closed')
                    ->sortable()
                    ->numeric()
                    ->summarize([
                        Sum::make(),
                        Average::make(),
                    ]),

                TextColumn::make('completed')
                    ->sortable()
                    ->numeric()
                    ->summarize([
                        Sum::make(),
                        Average::make(),
                    ]),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListWebcalls::route('/'),
            'create' => Pages\CreateWebcall::route('/create'),
            'edit' => Pages\EditWebcall::route('/{record}/edit'),
        ];
    }
}
