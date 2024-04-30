<?php

namespace App\Observers;

use App\Models\Monument;
use Illuminate\Support\Facades\Storage;

class MonumentObserver
{
    public function updated(Monument $monument): void
    {
        if ($monument->isDirty('monument_image')) {
            Storage::disk('public')->delete($monument->getOriginal('monument_image'));
        }
    }

    public function deleted(Monument $monument): void
    {
        Storage::disk('public')->delete($monument->monument_image);
    }
}
