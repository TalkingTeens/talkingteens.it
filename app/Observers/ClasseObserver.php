<?php

namespace App\Observers;

use App\Models\Classe;
use Illuminate\Support\Facades\Storage;

class ClasseObserver
{
    public function updated(Classe $class): void
    {
        if ($class->isDirty('photo') && !is_null($class->getOriginal('photo'))) {
            Storage::disk('public')->delete($class->getOriginal('photo'));
        }
    }

    public function deleted(Classe $class): void
    {
        if (!is_null($class->photo)) {
            Storage::disk('public')->delete($class->photo);
        }
    }

}
