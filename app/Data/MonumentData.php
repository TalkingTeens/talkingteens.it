<?php

namespace App\Data;

use App\Models\Monument;
use Spatie\LaravelData\Data;

class MonumentData extends Data
{
    public function __construct(
        public int     $id,
        public string  $slug,
        public string  $name,
        public float   $latitude,
        public float   $longitude,
        public string  $monument_image,
        public ?string $pin_image, // TODO: remove ?
        public string  $municipality_name,
    )
    {
    }

    public static function fromModel(Monument $monument): self
    {
        return self::from([
            'id' => $monument->id,
            'slug' => $monument->slug,
            'name' => $monument->name,
            'latitude' => $monument->latitude,
            'longitude' => $monument->longitude,
            'monument_image' => $monument->monument_image,
            'pin_image' => $monument->getFirstMedia('map')?->getUrl('pin'),
            'municipality_name' => $monument->municipality->name,
        ]);
    }
}
