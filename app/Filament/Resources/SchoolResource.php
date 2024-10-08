<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchoolResource\Pages;
use App\Filament\Resources\SchoolResource\RelationManagers;
use App\Models\School;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class SchoolResource extends Resource
{
    protected static ?string $model = School::class;

    protected static ?string $navigationGroup = 'Students';

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('miur_code')
                            ->required()
                            ->disabled(),

                        TextInput::make('website')
                            ->activeUrl()
                            ->placeholder('https://...')
                            ->suffixIcon('heroicon-o-globe-alt'),

                        TextInput::make('type')
                            ->required(),

                        TextInput::make('name')
                            ->required(),

                        TextInput::make('email')
                            ->email()
                            ->nullable(),

                        TextInput::make('pec')
                            ->email()
                            ->nullable(),
                    ])
                    ->columns(),

                Section::make('Address')
                    ->schema([
                        Select::make('municipality')
                            ->searchable()
                            ->relationship(titleAttribute: 'name')
                            ->required(),

                        TextInput::make('cap')
                            ->numeric()
                            ->mask('99999')
                            ->required(),

                        TextInput::make('address')
                            ->nullable()
                            ->columnSpanFull()
                    ])
                    ->columns(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('miur_code')
                    ->searchable(),

                TextColumn::make('type')
                    ->searchable(),

                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('municipality.name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('website')
                    ->copyable()
                    ->copyMessage('Website copied')
                    ->copyMessageDuration(1500)
                    ->searchable()
            ])
            ->filters([
                SelectFilter::make('municipality')
                    ->default('G337')
                    ->searchable()
                    ->relationship('municipality', 'name')
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
            RelationManagers\ClassesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSchools::route('/'),
            'edit' => Pages\EditSchool::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function canDeleteAny(): bool
    {
        return false;
    }
}
