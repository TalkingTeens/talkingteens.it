<?php

namespace App\Filament\Resources\DocumentResource\Widgets;

use App\Models\Document;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DocumentStats extends BaseWidget
{
    protected static ?string $pollingInterval = '10s';

    protected function getStats(): array
    {
        return [
            Stat::make('Views', Document::sum('opened')),
            Stat::make('Downloads', Document::sum('downloads')),
        ];
    }
}
