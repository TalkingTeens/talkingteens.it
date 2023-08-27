<?php

namespace App\Models;

use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Document extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'title',
        'category',
        'picture',
        'resource',
        'visible',
        'filename',
    ];

    public $translatable = [
        'title',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new ActiveScope);
    }
}
