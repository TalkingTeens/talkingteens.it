<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\Translatable\HasTranslations;

class Treater extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'last_name',
        'first_name',
    ];

    public $translatable = [
        'description',
    ];

    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function monuments(): MorphToMany
    {
        return $this->morphToMany(Monument::class, 'treatable');
    }
}
