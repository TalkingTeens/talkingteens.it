<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentResource\Pages;
use App\Models\Document;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\Summarizers\Count;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class DocumentResource extends Resource
{
    use Translatable;

    protected static ?string $model = Document::class;

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationGroup = 'Students';

    protected static ?string $navigationLabel = 'Didattica';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                TextInput::make('title')
                                    ->required()
                                    ->hint('Translatable')
                                    ->hintIcon('heroicon-o-language'),

                                Select::make('category')
                                    ->required()
                                    ->options([
                                        'project' => 'Project',
                                        'statues' => 'Statues',
                                        'activity' => 'Activity',
                                        'exercises' => 'Exercises',
                                    ]),
                            ])
                            ->columns(),

                        Section::make('Resource')
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('resource')
                                    ->conversion('preview')
                                    ->hiddenLabel()
                                    ->collection('didactics')
                                    ->maxSize(10240)
                                    ->openable()
                                    ->required(),
                            ]),
                    ])
                    ->columnSpan(['lg' => 2]),

                Group::make()->schema([
                    Section::make()
                        ->schema([
                            Placeholder::make('created_at')
                                ->content(fn(Document $record): ?string => $record->created_at?->diffForHumans()),

                            Placeholder::make('updated_at')
                                ->content(fn(Document $record): ?string => $record->updated_at?->diffForHumans()),
                        ])
                        ->hidden(fn(?Document $record) => $record === null),

                    Section::make('Status')
                        ->schema([
                            Toggle::make('visible')
                                ->helperText('This document will be hidden.')
                                ->default(true),
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
                SpatieMediaLibraryImageColumn::make('preview')
                    ->collection('didactics')
                    ->conversion('preview'),

                TextColumn::make('title')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('category')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'project' => 'warning',
                        'activity' => 'success',
                        'statues' => 'danger',
                        'exercises' => 'info',
                    }),

                TextColumn::make('opened')
                    ->sortable()
                    ->numeric()
                    ->summarize([
                        Sum::make(),
                    ]),

                TextColumn::make('downloads')
                    ->sortable()
                    ->numeric()
                    ->summarize([
                        Sum::make(),
                    ]),

                IconColumn::make('visible')
                    ->summarize(Count::make()->icons())
                    ->boolean(),
            ])
            ->filters([
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
            //
        ];
    }

    public static function getWidgets(): array
    {
        return [
            //
        ];
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDocuments::route('/'),
            'create' => Pages\CreateDocument::route('/create'),
            'edit' => Pages\EditDocument::route('/{record}/edit'),
        ];
    }
}
