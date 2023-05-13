<?php

namespace App\Filament\Resources\DocumentResource\Pages;

use App\Filament\Resources\DocumentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDocument extends CreateRecord
{
    protected static string $resource = DocumentResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
