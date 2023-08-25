<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Cookie extends Component
{
    public int $state;
    public bool $analytics;

    protected $listeners = ['manageCookies'];

    public function mount()
    {
        $cookies = \Cookie::get('cookie_consent');

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
            \Cookie::expire('_ga_3GJ7WZTD6J');
            \Cookie::expire('_ga');
        }
    }

    public function store($value): void
    {
        \Cookie::queue('cookie_consent', $value, 60 * 24 * 365);
        $this->state = 0;
    }

    public function manageCookies(): void
    {
        $this->state = 2;
    }

    public function render()
    {
        return view('livewire.cookie');
    }
}
