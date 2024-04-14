<?php

namespace App\Data;

use App\Models\School;
use Spatie\LaravelData\Data;

class SchoolData extends Data
{
    public function __construct(
        public string $full_name,
    )
    {
    }

    public static function fromModel(School $school): self
    {
        return self::from([
            'full_name' => $school->full_name,
        ]);
    }
}
