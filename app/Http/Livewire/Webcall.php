<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Monument;

class Webcall extends Component
{
    public $monument;
    public $webcall;
//    public $supportedLangs;
    public $lang = '';
    public $state;

    protected $queryString = [
        'lang' => ['except' => '', 'as' => 'l'],
    ];

    public function mount(Monument $monument): void
    {
        $this->monument = $monument;

        $this->webcall = $this->monument->webcall;

//        dd($this->webcall->resources);

//        $this->supportedLangs = $this->webcall->resources->pluck('resource', 'language');

        $this->check();
    }

    public function check(): void
    {
        if (!$this->webcall || empty($this->webcall->resources))
        {
            abort(404);
        }


        $this->checkExternal();

        if (in_array($this->lang, $this->supportedLangs->keys()->all()))
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
        $this->lang = $lang;

        $this->checkExternal();

        $this->setState(1);
    }

    public function checkExternal()
    {
        if (in_array($this->lang, ["lis"]))
        {
            $this->setState(3);
            return redirect()->away($this->supportedLangs[$this->lang]);
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
        $this->reset(['lang']);

        $this->setState(0);
    }

    public function setState($state): void
    {
        $this->state = $state;
    }

    public function render()
    {
        return view('livewire.webcall');
    }
}
