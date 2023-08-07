<?php

namespace App\Filament\Resources\SupporterResource\Pages;

use App\Filament\Resources\SupporterResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSupporters extends ManageRecords
{
    protected static string $resource = SupporterResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
