<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers\MonumentsRelationManager;
use App\Models\Category;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CategoryResource extends Resource
{
    use Translatable;

    protected static ?string $model = Category::class;

    protected static ?string $navigationGroup = 'Statues';

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->hint('Translatable')
                            ->hintIcon('heroicon-o-language')
                            ->required(),

                        SpatieMediaLibraryFileUpload::make('icon')
                            ->collection('categories')
                            ->image(),
                    ])
                    ->columns()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('icon')
                    ->collection('categories'),

                TextColumn::make('name')
//                    ->searchable() // TODO:
                    ->sortable(),

                SpatieMediaLibraryImageColumn::make('monuments.monument_image')
                    ->collection('monuments')
                    ->limit()
                    ->limitedRemainingText(isSeparate: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('order_column')
            ->reorderable('order_column');
    }

    public static function getRelations(): array
    {
        return [
            MonumentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
