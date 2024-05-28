<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RedirectResource\Pages;
use App\Models\Redirect;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

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
                TextColumn::make('from')
                    ->sortable(),

                TextColumn::make('to')
                    ->sortable(),

                TextColumn::make('subdomain')
                    ->sortable()
                    ->badge(),
            ])
            ->filters([
                SelectFilter::make('subdomain')
                    ->options([
                        'call' => 'call',
                    ])
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
