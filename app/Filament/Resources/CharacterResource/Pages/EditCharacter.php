<?php

namespace App\Filament\Resources\CharacterResource\Pages;

use App\Filament\Resources\CharacterResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCharacter extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = CharacterResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
