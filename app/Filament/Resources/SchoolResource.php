<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchoolResource\Pages;
use App\Filament\Resources\SchoolResource\RelationManagers;
use App\Models\School;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SchoolResource extends Resource
{
    protected static ?string $model = School::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        Card::make()
                            ->schema([
                                TextInput::make('miur_code')
                                    ->required()
                                    ->disabled(),

                                TextInput::make('website')
                                    // ->url()
                                    ->nullable(),

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
                            ->columns(2),
                    ])
                    ->columnSpan(['lg' => 2]),

                Group::make()->schema([
                    Section::make('Address')
                        ->schema([
                            Select::make('municipality_code')
                                ->searchable()
                                ->relationship('municipality', 'name')
                                ->required(),

                            TextInput::make('cap')
                                ->numeric()
                                ->mask(fn (TextInput\Mask $mask) => $mask->pattern('00000'))
                                ->required(),

                            TextInput::make('address')
                                ->nullable(),
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
                TextColumn::make('miur_code')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('municipality.name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('website')
                    ->copyable()
                    ->copyMessage('Website copied')
                    ->copyMessageDuration(1500)
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
