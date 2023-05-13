<?php

namespace App\Filament\Resources;

use Closure;
use App\Filament\Resources\DocumentResource\Pages;
use App\Filament\Resources\DocumentResource\RelationManagers;
use App\Models\Document;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\BadgeColumn;

class DocumentResource extends Resource
{
    protected static ?string $model = Document::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)->schema([
                    Card::make()->schema([
                        TextInput::make('title')
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function (Closure $set, $state) {
                                $set('filename', Str::slug($state));
                            }),
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
                            ->required(),
                        FileUpload::make('picture')
                            ->image()
                            ->directory('images/documents')
                            ->nullable(),
                    ])->columns(2)->columnSpan(2),
                Section::make('Heading')
                    ->schema([
                        Toggle::make('visible')
                            ->default(1)
                            ->onIcon('heroicon-s-eye'),
                    ])->columnSpan(1),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('picture'),
                TextColumn::make('title')
                    ->sortable()
                    ->searchable(),
                BadgeColumn::make('category'),
                TextColumn::make('opened')
                    ->sortable(),
                TextColumn::make('downloads')
                    ->sortable(),
                IconColumn::make('visible')
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
    
    public static function getRelations(): array
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
