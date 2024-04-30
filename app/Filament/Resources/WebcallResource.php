<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WebcallResource\Pages;
use App\Filament\Resources\WebcallResource\RelationManagers;
use App\Models\Webcall;
use Filament\Forms;
use Filament\Forms\Components\Builder as WebcallBuilder;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\Summarizers\Average;
use Filament\Tables\Columns\Summarizers\Range;
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
                Select::make('monument_id')
                    ->searchable()
                    ->relationship('monument', 'name')
                    ->required(),

                SpatieMediaLibraryFileUpload::make('background')
                    ->collection('webcalls')
                    ->image()
                    ->required(),

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
                                    ->searchable()
                                    ->multiple()
                                    ->relationship('voices', 'last_name')
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
                            ->columns(2),

                        WebcallBuilder\Block::make('link')->icon('heroicon-o-link')
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
                            ->columns(2),
                    ]),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('background')
                    ->collection('webcalls'),

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
