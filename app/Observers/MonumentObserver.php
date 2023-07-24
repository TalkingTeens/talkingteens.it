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

        if ($monument->isDirty('pin_image') && !is_null($monument->getOriginal('pin_image'))) {
            Storage::disk('public')->delete($monument->getOriginal('pin_image'));
        }
    }

    public function deleted(Monument $monument): void
    {
        Storage::disk('public')->delete($monument->monument_image);

        if (!is_null($monument->pin_image)) {
            Storage::disk('public')->delete($monument->pin_image);
        }
    }
}
