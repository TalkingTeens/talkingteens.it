<?php

namespace App\Observers;

use App\Models\Character;
use Illuminate\Support\Facades\Storage;

class CharacterObserver
{
    public function updated(Character $character): void
    {

        if ($character->isDirty('picture') && !is_null($character->getOriginal('picture'))) {
            Storage::disk('public')->delete($character->getOriginal('picture'));
        }
    }

    public function deleted(Character $character): void
    {
        if (!is_null($character->picture)) {
            Storage::disk('public')->delete($character->picture);
        }
    }
}
