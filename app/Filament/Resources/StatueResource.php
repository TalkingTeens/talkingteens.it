<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StatueResource\Pages;
use App\Filament\Resources\StatueResource\RelationManagers;
use App\Models\Statue;
use Filament\Forms;
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
use Filament\Resources\Concerns\Translatable;

class StatueResource extends Resource
{
    use Translatable;

    protected static ?string $model = Statue::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('statue_image'),
                TextColumn::make('name')
                    ->sortable()
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStatues::route('/'),
            'create' => Pages\CreateStatue::route('/create'),
            'edit' => Pages\EditStatue::route('/{record}/edit'),
        ];
    }
}
