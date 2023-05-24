<?php

namespace App\Filament\Resources\SponsorResource\Pages;

use App\Filament\Resources\SponsorResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSponsor extends EditRecord
{
//    use EditRecord\Concerns\Translatable;

    protected static string $resource = SponsorResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
//            Actions\LocaleSwitcher::make(),
        ];
    }
}
