<?php

namespace App\Filament\Resources\StatueResource\Pages;

use App\Filament\Resources\StatueResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStatue extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = StatueResource::class;

    protected function getActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
