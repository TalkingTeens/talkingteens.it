<?php

namespace App\Observers;

use App\Models\Document;
use Illuminate\Support\Facades\Storage;

class DocumentObserver
{
    public function updated(Document $document): void
    {
        if ($document->isDirty('resource')) {
            Storage::disk('public')->delete($document->getOriginal('resource'));
        }

        if ($document->isDirty('picture') && !is_null($document->getOriginal('picture'))) {
            Storage::disk('public')->delete($document->getOriginal('picture'));
        }
    }

    public function deleted(Document $document): void
    {
        Storage::disk('public')->delete($document->resource);

        if (!is_null($document->picture)) {
            Storage::disk('public')->delete($document->picture);
        }
    }
}
