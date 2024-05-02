<?php

namespace App\Filament\Resources\WebcallResource\Pages;

use App\Filament\Resources\WebcallResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWebcall extends EditRecord
{
    protected static string $resource = WebcallResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
