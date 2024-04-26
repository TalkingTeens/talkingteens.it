<?php

namespace App\Models;

use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Document extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia;

    protected $fillable = [
        'title',
        'category',
        'visible',
    ];

    public $translatable = [
        'title',
    ];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('preview')
            ->performOnCollections('didactics')
            ->nonQueued()
            ->width(500);
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new ActiveScope);
    }
}
