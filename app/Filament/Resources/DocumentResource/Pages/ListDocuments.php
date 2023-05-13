<?php

namespace App\Filament\Resources\DocumentResource\Pages;

use App\Filament\Resources\DocumentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDocuments extends ListRecords
{
    protected static string $resource = DocumentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
