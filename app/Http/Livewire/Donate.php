<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Donate extends Component
{
    public string $method = '';

    protected $queryString = [
        'method' => ['except' => '', 'as' => 'm'],
    ];

    public function setMethod($method): void
    {
        $this->method = $method;
    }

    public function render()
    {
        return view('livewire.donate');
    }
}
