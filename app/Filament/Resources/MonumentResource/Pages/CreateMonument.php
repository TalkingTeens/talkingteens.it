<?php

namespace App\Filament\Resources\MonumentResource\Pages;

use App\Filament\Resources\MonumentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMonument extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = MonumentResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
