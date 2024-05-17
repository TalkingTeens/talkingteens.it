<?php

namespace App\Livewire;

use App\Models\User;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use Spatie\Newsletter\Facades\Newsletter as Mailchimp;

class Newsletter extends Component
{
    public string $email = '';

    public bool $consent = false;

    public bool $subscribed = false;

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
            // Mailchimp::hasMember($this->email);
            // Mailchimp::isSubscribed($this->email);

            Mailchimp::subscribe($this->email);
        }

        $this->subscribed = true;

        $this->notify();
    }

    private function notify(): void
    {
        $recipients = User::all();

        $notification = Notification::make()
            ->title('Nuova email!')
            ->body($this->email . ' si è appena iscritto alla newsletter')
            ->success()
            ->icon('heroicon-o-envelope')
            ->actions([
                Action::make('open')
                    ->button()
                    ->url('https://mailchimp.com/', shouldOpenInNewTab: true)
                    ->markAsRead(),
            ]);

        foreach ($recipients as $recipient) {
            $notification->sendToDatabase($recipient);
        }
    }

    public function render()
    {
        return view('livewire.newsletter');
    }
}
