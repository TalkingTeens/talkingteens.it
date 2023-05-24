<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Municipality extends Model
{
    use HasFactory;

/*    public function statues(): HasMany
    {
        return $this->hasMany(Statue::class);
    }

    public function municipality(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }*/
}
