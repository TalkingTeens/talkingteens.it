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
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Tags\HasTags;
use Spatie\Translatable\HasTranslations;

class Monument extends Model implements HasMedia
{
    use HasFactory, HasTranslations, HasTags, InteractsWithMedia;

    public $translatable = [
        'name',
        'description',
    ];
    protected $fillable = [
        'name',
        'slug',
        'description',
        'latitude',
        'longitude',
        'phone_number',
        'municipality_code',
        'visible',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new ActiveScope);
    }

//    public function getSlugOptions(): SlugOptions
//    {
//        return SlugOptions::create()
//            ->generateSlugsFrom('name')
//            ->saveSlugsTo('slug')
//            ->usingLanguage('it');
//    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('pin')
            ->format('webp')
            ->performOnCollections('map')
            ->nonQueued()
            ->width(100);
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

    public function tags(): MorphToMany
    {
        return $this
            ->morphToMany(self::getTagClassName(), 'taggable', 'taggables', null, 'tag_id')
            ->orderBy('order_column');
    }

    public static function getTagClassName(): string
    {
        return Category::class;
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
