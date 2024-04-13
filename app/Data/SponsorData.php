<?php

namespace App\Data;

use App\Models\Sponsor;
use Spatie\LaravelData\Data;

class SponsorData extends Data
{
    public function __construct(
        public string  $name,
        public ?string $logo, // TODO: remove ?
        public ?string $resource,
    )
    {
    }

    public static function fromModel(Sponsor $sponsor): self
    {
        return self::from([
            'name' => $sponsor->name,
            'logo' => $sponsor->getFirstMedia('logos')?->getFullUrl(), // TODO: remove ?
            'resource' => $sponsor->resource,
        ]);
    }
}
