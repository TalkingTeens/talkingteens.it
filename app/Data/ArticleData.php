<?php

namespace App\Data;

use App\Models\Article;
use Spatie\LaravelData\Data;

class ArticleData extends Data
{
    public function __construct(
        public string $name,
        public ?string $logo,
        public ?string $resource,
    ) {
    }

    public static function fromModel(Article $article): self
    {
        return self::from([
            'name' => $article->name,
            'logo' => $article->getFirstMedia('logos')?->getFullUrl(),
            'resource' => $article->getFirstMedia('articles')?->getFullUrl() ?? $article->link,
        ]);
    }
}
