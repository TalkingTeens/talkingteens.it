<?php

namespace App\Livewire;

use Illuminate\Support\Facades\App;
use Livewire\Component;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\Newsletter\Facades\Newsletter as Mailchimp;

class Newsletter extends Component
{
    public string $email = '';

    public bool $consent = false;

    public bool $submitted = false;

    public function rules(): array
    {
        return [
            'email' => 'required|email:rfc,dns',
            'consent' => 'boolean',
        ];
    }

    public function save(): void
    {
        $this->validate();

        if (App::environment('production')) {
            Mailchimp::subscribe(email: $this->email, options: [
                'status' => 'pending', // Needed for double opt-in
                'language' => LaravelLocalization::getCurrentLocale()
            ]);
        }

        $this->submitted = true;
    }

    public function render()
    {
        return view('livewire.newsletter');
    }
}
