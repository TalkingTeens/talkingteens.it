<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Monument;
use Livewire\Attributes\Url;

class Webcall extends Component
{
    public Monument $monument;
    public $webcall;
    public $langs;
    #[Url(as: 'l')]
    public string $activeLang = '';
    public int $state;

    public function mount(Monument $monument): void
    {
        $this->monument = $monument;

        $this->webcall = $this->monument->webcall;

        if (empty($this->webcall?->resources)) abort(404);

        $this->langs = collect(array_column($this->webcall->resources, 'data'))
            ->pluck('resource', 'language');

        $this->check();
    }

    public function check(): void
    {
        $this->checkExternal();

        if (in_array($this->activeLang, $this->langs->keys()->all()))
        {
            $this->setState(1);
        }
    }

    public function setLang($lang): void
    {
        $this->activeLang = $lang;

        $this->checkExternal();

        $this->setState(1);
    }

    public function checkExternal()
    {
        if (in_array($this->activeLang, ["lis"]))
        {
            $this->setState(3);
            return redirect()->away($this->langs[$this->activeLang]);
        }
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
            ->title($this->monument->name . ' Webcall')
            ->extends('layouts.base')
            ->section('body');
    }
}
