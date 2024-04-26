<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Author extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia;

    protected $fillable = [
        'last_name',
        'first_name',
        'slug',
        'description',
        'birth_year',
        'death_year',
    ];

    public $translatable = [
        'description',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function monuments(): BelongsToMany
    {
        return $this->belongsToMany(Monument::class);
    }
}
