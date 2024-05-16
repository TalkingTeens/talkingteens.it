<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Character extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia;

    protected $fillable = [
        'name',
        'birth_year',
        'death_year',
        'description',
    ];

    public $translatable = [
        'name',
        'description',
    ];

    public function monuments(): BelongsToMany
    {
        return $this->belongsToMany(Monument::class);
    }
}
