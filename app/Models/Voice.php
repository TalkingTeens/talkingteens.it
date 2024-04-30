<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Voice extends Model
{
    use HasFactory;

    protected $fillable = [
        'last_name',
        'first_name',
        'picture',
    ];

    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function webcalls(): BelongsToMany
    {
        return $this->belongsToMany(Webcall::class);
    }
}
