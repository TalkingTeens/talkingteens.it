<?php

namespace App\Models;

use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\Tags\HasTags;
use Spatie\Translatable\HasTranslations;

class Monument extends Model
{
    use HasFactory, HasTranslations, HasTags;

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

    public static function getTagClassName(): string
    {
        return Category::class;
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

    public function tags(): MorphToMany
    {
        return $this
            ->morphToMany(self::getTagClassName(), 'taggable', 'taggables', null, 'tag_id')
            ->orderBy('order_column');
    }

    public function categories(): MorphToMany
    {
        return $this->morphToMany(Category::class, 'taggable', 'taggables', null, 'tag_id');
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

    public function scopeOfMunicipality(Builder $query, string $code): void
    {
        $query->where('municipality_code', $code);
    }
}
