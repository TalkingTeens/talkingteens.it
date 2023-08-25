<?php

namespace App\Models;

use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Translatable\HasTranslations;

class Monument extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'monument_image',
        'background_image',
        'pin_image',
        'latitude',
        'longitude',
        'phone_number',
        'municipality_code',
        'visible',
    ];

    public $translatable = [
        'name',
        'description',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new ActiveScope);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function municipality(): BelongsTo
    {
        return $this->belongsTo(Municipality::class);
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class);
    }

    public function webcall(): HasOne
    {
        return $this->hasOne(Webcall::class);
    }

    public function characters(): BelongsToMany
    {
        return $this->belongsToMany(Character::class)
            ->withPivot('description');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function classes()
    {
        return $this->morphedByMany(Classe::class, 'treatable')
            ->withPivot('photo', 'description');
    }

    public function treaters()
    {
        return $this->morphedByMany(Treater::class, 'treatable')
            ->withPivot('photo', 'description');
    }
}
