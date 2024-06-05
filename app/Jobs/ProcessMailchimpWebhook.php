<?php

namespace App\Jobs;

use App\Models\User;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Spatie\WebhookClient\Jobs\ProcessWebhookJob;

class ProcessMailchimpWebhook extends ProcessWebhookJob
{
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $payload = $this->webhookCall->payload;

        $type = $payload['type'];
        $email = $payload['data']['email'];

        match ($type) {
            'subscribe', 'unsubscribe' => $this->notify($type, $email),
            default => false,
        };
    }

    private function notify($type, $email): bool
    {
        $recipients = User::all();

        $notification = Notification::make()
            ->title(__("admin.notification.newsletter.{$type}.title"))
            ->body(__("admin.notification.newsletter.{$type}.body", ['email' => $email]))
            ->success()
            ->icon('heroicon-o-envelope')
            ->actions([
                Action::make('open')
                    ->button()
                    ->url(url: 'https://us19.admin.mailchimp.com/audience/contacts', shouldOpenInNewTab: true)
                    ->markAsRead(),
            ]);

        foreach ($recipients as $recipient) {
            $notification->sendToDatabase($recipient);
        }

        return true;
    }
}
