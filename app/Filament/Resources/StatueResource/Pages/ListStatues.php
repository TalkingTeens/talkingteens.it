<?php

namespace App\Filament\Resources\StatueResource\Pages;

use App\Filament\Resources\StatueResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStatues extends ListRecords
{
    protected static string $resource = StatueResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
