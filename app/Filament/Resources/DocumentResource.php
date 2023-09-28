<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentResource\Widgets\DocumentStats;
use Closure;
use App\Filament\Resources\DocumentResource\Pages;
use App\Filament\Resources\DocumentResource\RelationManagers;
use App\Models\Document;
use Filament\Forms;
use Filament\Resources\Concerns\Translatable;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\Summarizers\Sum;

class DocumentResource extends Resource
{
    use Translatable;

    protected static ?string $model = Document::class;

    protected static ?string $navigationGroup = 'Settings';

    protected static ?string $recordTitleAttribute = 'title';

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
                            ->reactive()
                            ->afterStateUpdated(fn (string $context, $state, callable $set) => $context === 'create' ? $set('filename', Str::slug($state)) : null),

                        TextInput::make('filename')
                            ->required(),

                        Select::make('category')
                            ->required()
                            ->options([
                                'project' => 'Project',
                                'statues' => 'Statues',
                                'activity' => 'Activity',
                                'exercises' => 'Exercises',
                            ]),

                        FileUpload::make('resource')
                            ->directory('documents')
                            ->openable()
                            ->required(),
                    ])
                    ->columns(2),

                    Section::make('Cover')
                        ->schema([
                            FileUpload::make('picture')
                                ->image()
                                ->directory('images/documents')
                                ->nullable()
                                ->disableLabel(),
                        ])
                        ->collapsible(),
                ])
                ->columnSpan(['lg' => 2]),

                Group::make()->schema([
                    Section::make()
                        ->schema([
                            Placeholder::make('created_at')
                                ->content(fn (Document $record): ?string => $record->created_at?->diffForHumans()),

                            Placeholder::make('updated_at')
                                ->content(fn (Document $record): ?string => $record->updated_at?->diffForHumans()),
                        ])
                        ->hidden(fn (?Document $record) => $record === null),

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
                ImageColumn::make('picture'),

                TextColumn::make('title')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('category')
                    ->badge(),

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

    public static function getGloballySearchableAttributes(): array
    {
        return ['filename'];
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
            DocumentStats::class,
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
