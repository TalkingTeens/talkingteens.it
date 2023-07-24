<?php

namespace App\Filament\Resources\MonumentResource\Pages;

use App\Filament\Resources\MonumentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMonuments extends ListRecords
{

    protected static string $resource = MonumentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
