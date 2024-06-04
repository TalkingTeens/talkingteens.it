<?php

namespace App\Livewire;

use App\Models\User;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
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

        if (!App::environment('production')) {
//            $a = Mailchimp::hasMember($this->email);
//            $b = Mailchimp::isSubscribed($this->email);

            $member = Mailchimp::subscribe(email: $this->email, options: [
                'status' => 'pending'
            ]);

            if ($member) {
                $this->notify($member["contact_id"]);
            }
        }

        $this->subscribed = true;
    }

    private function notify($contact_id): void
    {
        $recipients = User::all();

        $url = "https://us19.admin.mailchimp.com/audience/contact-profile?contact_id={$contact_id}";

        $notification = Notification::make()
            ->title('Nuova email!')
            ->body($this->email.' si è appena iscritto alla newsletter')
            ->success()
            ->icon('heroicon-o-envelope')
            ->actions([
                Action::make('open')
                    ->button()
                    ->url($url, shouldOpenInNewTab: true)
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
