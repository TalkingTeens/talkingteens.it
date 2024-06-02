<?php

namespace App\Filament\Resources\WebcallResource\Pages;

use App\Filament\Resources\WebcallResource;
use Filament\Resources\Pages\CreateRecord;

class CreateWebcall extends CreateRecord
{
    protected static string $resource = WebcallResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

//    protected function mutateFormDataBeforeCreate(array $data): array
//    {
//        dd($data['type']);
//    }
}
