<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryObserver
{
    public function updated(Category $category): void
    {
        if ($category->isDirty('icon') && !is_null($category->getOriginal('icon'))) {
            Storage::disk('public')->delete($category->getOriginal('icon'));
        }
    }

    public function deleted(Category $category): void
    {
        if (!is_null($category->icon)) {
            Storage::disk('public')->delete($category->icon);
        }
    }
}
