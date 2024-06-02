<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Treatable extends MorphPivot
{
    use HasTranslations, InteractsWithMedia;

    public $translatable = [
        'description'
    ];
}
