<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class DocumentData extends Data
{
    public function __construct(
        public array $title,
    ) {}
}
