<?php

namespace App\Filament\Resources\CharacterResource\RelationManagers;

use App\Filament\Resources\MonumentResource;
use App\Models\Monument;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;

class MonumentsRelationManager extends RelationManager
{
    protected static string $relationship = 'monuments';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('slug')
            ->columns([
                SpatieMediaLibraryImageColumn::make('monument_image')
                    ->collection('monuments'),

                Tables\Columns\TextColumn::make('name'),

                Tables\Columns\TextColumn::make('municipality.name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make(),
            ])
            ->actions([
                Tables\Actions\Action::make('Apri')
                    ->url(fn(Monument $record): string => MonumentResource::getUrl('edit', ['record' => $record]))
                    ->icon('heroicon-s-eye'),

                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DetachBulkAction::make(),
            ]);
    }
}
