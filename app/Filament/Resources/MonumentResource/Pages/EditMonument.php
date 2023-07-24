<?php

namespace App\Filament\Resources\MonumentResource\Pages;

use App\Filament\Resources\MonumentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMonument extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = MonumentResource::class;

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
