<?php

namespace App\Observers;

use App\Models\Sponsor;
use Illuminate\Support\Facades\Storage;

class SponsorObserver
{
    public function updated(Sponsor $sponsor): void
    {
        if ($sponsor->isDirty('logo'))
        {
            Storage::disk('public')->delete($sponsor->getOriginal('logo'));
        }
    }

    public function deleted(Sponsor $sponsor): void
    {
        Storage::disk('public')->delete($sponsor->logo);
    }
}
