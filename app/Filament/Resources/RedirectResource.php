<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RedirectResource\Pages;
use App\Filament\Resources\RedirectResource\RelationManagers;
use App\Models\Redirect;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class RedirectResource extends Resource
{
    protected static ?string $model = Redirect::class;

    protected static ?string $navigationGroup = 'Management';

    protected static ?string $navigationIcon = 'heroicon-o-arrows-right-left';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('from')
                    ->prefix('/')
                    ->required()
                    ->unique(ignoreRecord: true),

                TextInput::make('to')
                    ->different('from')
                    ->required()
                    ->prefix('/'),

                Select::make('subdomain')
                    ->options([
                        'call' => 'call',
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('from'),

                TextColumn::make('to'),

                TextColumn::make('subdomain'),
            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                //
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageRedirects::route('/'),
        ];
    }
}
