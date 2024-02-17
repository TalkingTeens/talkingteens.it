<?php

namespace App\Filament\Resources\DocumentResource\Pages;

use App\Filament\Resources\DocumentResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListDocuments extends ListRecords
{
    protected static string $resource = DocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return DocumentResource::getWidgets();
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
            'project' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('category', 'project')),
            'statues' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('category', 'statues')),
            'activity' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('category', 'activity')),
            'exercises' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('category', 'exercises')),
        ];
    }

    public function getDefaultActiveTab(): string|int|null
    {
        return 'all';
    }
}
