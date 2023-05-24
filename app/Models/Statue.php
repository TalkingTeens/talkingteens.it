<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Statue extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = [
        'name',
        'role',
        'character_history',
        'monument_history',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function municipality(): BelongsTo
    {
        return $this->belongsTo(Municipality::class, 'municipality_code', 'code');
    }
}
