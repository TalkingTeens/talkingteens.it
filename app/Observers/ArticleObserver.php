<?php

namespace App\Observers;

use App\Models\Article;
use Illuminate\Support\Facades\Storage;

class ArticleObserver
{
    public function updated(Article $article): void
    {
        if ($article->isDirty('logo') && !is_null($article->getOriginal('logo'))) {
            Storage::disk('public')->delete($article->getOriginal('logo'));
        }
    }

    public function deleted(Article $article): void
    {
        if (!is_null($article->logo)) {
            Storage::disk('public')->delete($article->logo);
        }
    }
}
