<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Monument;
use Illuminate\Support\Arr;

class Webcall extends Component
{
    public Monument $monument;

    public $webcall;

    public $langs;

    public int $state;

    public function mount(Monument $monument): void
    {
        $this->monument = $monument;
        $this->webcall = $monument->webcall;

        if (empty($this->webcall?->resources)) abort(404);

        $this->langs = collect(array_column($this->webcall->resources, 'data'))
            ->pluck('resource', 'language')
            ->sortKeys();
    }

    public function started(): void
    {
        $this->webcall->increment("started");
    }

    public function completed(): void
    {
        $this->webcall->increment("completed");
    }

    public function closed(): void
    {
        $this->webcall->increment("closed");
    }

    public function render()
    {
        return view('livewire.webcall')
            // TODO: translation variable
            ->title(Arr::join([__('webcall.title'), $this->monument->name], ' '))
            ->extends('layouts.base')
            ->section('body');
    }
}
