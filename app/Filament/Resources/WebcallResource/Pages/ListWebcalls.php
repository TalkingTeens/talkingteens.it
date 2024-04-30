<?php

namespace App\Filament\Resources\WebcallResource\Pages;

use App\Filament\Resources\WebcallResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWebcalls extends ListRecords
{
    protected static string $resource = WebcallResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
