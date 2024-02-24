<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\App;
use Spatie\Newsletter\Facades\Newsletter as Mailchimp;

class Newsletter extends Component
{
    public string $email = '';

    public bool $subscribed = false;

    public function rules(): array
    {
        return [
            'email' => 'required|email:rfc,dns',
        ];
    }

    public function save(): void
    {
        $this->validate();

        if (App::environment('production')) {
            Mailchimp::subscribe($this->email);
        }

        $this->subscribed = true;
    }

    public function render()
    {
        return view('livewire.newsletter');
    }
}
