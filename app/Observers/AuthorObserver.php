<?php

namespace App\Observers;

use App\Models\Author;
use Illuminate\Support\Facades\Storage;

class AuthorObserver
{
    public function updated(Author $author): void
    {
        if ($author->isDirty('picture') && !is_null($author->getOriginal('picture'))) {
            Storage::disk('public')->delete($author->getOriginal('picture'));
        }
    }

    public function deleted(Author $author): void
    {
        if (!is_null($author->picture)) {
            Storage::disk('public')->delete($author->picture);
        }
    }
}
