<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Webcall extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $casts = [
        'resources' => 'array',
    ];

    protected $fillable = [
        'resources'
    ];

    public function monument(): BelongsTo
    {
        return $this->belongsTo(Monument::class);
    }

    public function voices(): BelongsToMany
    {
        return $this->belongsToMany(Voice::class);
    }
}
