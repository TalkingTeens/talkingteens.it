<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SupporterResource\Pages;
use Filament\Tables\Columns\Summarizers\Count;
use Filament\Tables\Filters\TernaryFilter;
use App\Models\Supporter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;

class SupporterResource extends Resource
{
    protected static ?string $model = Supporter::class;

    protected static ?string $navigationGroup = 'Contributions';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('full_name')
                    ->required(),

                Select::make('type')
                    ->required()
                    ->options([
                        'student' => 'Student',
                        'other' => 'Other',
                    ]),

                Toggle::make('visible')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('full_name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('type')
                    ->badge(),

                IconColumn::make('visible')
                    ->summarize(Count::make()->icons())
                    ->boolean(),
            ])
            ->filters([
                TernaryFilter::make('visible')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withoutGlobalScopes();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSupporters::route('/'),
        ];
    }
}
