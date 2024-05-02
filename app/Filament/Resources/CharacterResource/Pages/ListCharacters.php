<?php

namespace App\Filament\Resources\CharacterResource\Pages;

use App\Filament\Resources\CharacterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCharacters extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = CharacterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
