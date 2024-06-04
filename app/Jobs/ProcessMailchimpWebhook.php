<?php

namespace App\Jobs;

use Spatie\WebhookClient\Jobs\ProcessWebhookJob as SpatieProcessWebhookJob;

class ProcessMailchimpWebhook extends SpatieProcessWebhookJob
{
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // dd($this->webhookCall);
    }
}
