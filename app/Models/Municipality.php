<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Municipality extends Model
{
    use HasFactory;

    protected $primaryKey = 'code';
    public $incrementing = false;

    protected $fillable = [
        'description',
    ];

//    public $translatable = [
//        'description',
//    ];

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function monuments(): HasMany
    {
        return $this->hasMany(Monument::class);
    }

    public function getDisplayName(): string
    {
        return "{$this->name}, {$this->province->region->name}";
    }
}
