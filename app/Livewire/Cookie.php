<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Cookie as CookieFacade;

class Cookie extends Component
{
    public int $state;

    public bool $analytics;

    public function mount()
    {
        $cookies = CookieFacade::get('cookie_consent');

        $this->analytics = $cookies ?? false;
        $this->state = is_null($cookies);
    }

    public function accept(): void
    {
        $this->store(true);
    }

    public function reject(): void
    {
        $this->store(false);
    }

    public function save(): void
    {
        $this->store($this->analytics);

        if (!$this->analytics)
        {
            CookieFacade::expire('_ga_3GJ7WZTD6J');
            CookieFacade::expire('_ga');
        }
    }

    public function store($value): void
    {
        CookieFacade::queue('cookie_consent', $value, 60 * 60 * 24 * 365);
        $this->state = 0;
    }

    public function render()
    {
        return view('livewire.cookie');
    }
}
