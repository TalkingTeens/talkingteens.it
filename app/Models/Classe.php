<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Classe extends Model
{
    use HasFactory;

    protected $fillable = [
        'grade',
        'section',
        'discipline',
        'year',
        'school_miur_code',
    ];

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(Teacher::class, 'class_teacher');
    }

    public function monuments(): MorphToMany
    {
        return $this->morphToMany(Monument::class, 'treatable');
    }
}
