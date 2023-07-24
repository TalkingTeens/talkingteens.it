<?php

namespace App\Filament\Resources\DocumentResource\Widgets;

use App\Models\Document;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class DocumentStats extends BaseWidget
{
    protected static ?string $pollingInterval = '10s';

    protected function getCards(): array
    {
        return [
            Card::make('Views', Document::sum('opened')),
            Card::make('Downloads', Document::sum('downloads')),
        ];
    }
}
