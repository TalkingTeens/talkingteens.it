<?php

namespace App\Data;

use App\Models\Sponsor;
use Spatie\LaravelData\Data;

class SponsorData extends Data
{
    public function __construct(
        public string $name,
        public ?string $logo,
        public ?string $resource,
    ) {
    }

    public static function fromModel(Sponsor $sponsor): self
    {
        return self::from([
            'name' => $sponsor->name,
            'logo' => $sponsor->getFirstMedia('logos')?->getFullUrl(),
            'resource' => $sponsor->resource,
        ]);
    }
}
