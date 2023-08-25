<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Webcall extends Model
{
    use HasFactory;

    protected $casts = [
        'resources' => 'array',
    ];

    protected $fillable = [
        'resources',
    ];

    public function voices(): BelongsToMany
    {
        return $this->belongsToMany(Voice::class);
    }
}
