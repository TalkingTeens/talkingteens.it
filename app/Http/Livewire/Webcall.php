<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Monument;

class Webcall extends Component
{
    public Monument $monument;
    public $webcall;
    public $langs;
    public string $activeLang = '';
    public int $state;

    protected $queryString = [
        'activeLang' => ['except' => '', 'as' => 'l'],
    ];

    public function mount(Monument $monument): void
    {
        $this->monument = $monument;

        $this->webcall = $this->monument->webcall;

        $this->langs = collect(array_column($this->webcall->resources, 'data'))
            ->pluck('resource', 'language');

        $this->check();
    }

    public function check(): void
    {
        if (!$this->webcall || empty($this->webcall->resources))
        {
            abort(404);
        }

        $this->checkExternal();

        if (in_array($this->activeLang, $this->langs->keys()->all()))
        {
            $this->setState(1);
        }
        else
        {
            $this->replay();
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

    public function answer(): void
    {
        $this->setState(2);

        $this->webcall->increment("started");
    }

    public function hangUp(): void
    {
        $this->setState(3);

        $this->webcall->increment("closed");
    }

    public function replay(): void
    {
        $this->reset(['activeLang']);

        $this->setState(0);
    }

    public function setState($state): void
    {
        $this->state = $state;
    }

    public function render()
    {
        return view('livewire.webcall')
            ->extends('layouts.base')
            ->section('body');
    }
}
