<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'email',
        'pec',
        'website',
        'municipality_code',
        'cap',
        'address',
    ];

    protected $primaryKey = 'miur_code';

    protected $keyType = 'string';

    public function getFullNameAttribute(): string
    {
        return $this->type . ' ' . $this->name;
    }

    public function municipality(): BelongsTo
    {
        return $this->belongsTo(Municipality::class, 'municipality_code', 'code');
    }

    public function classes(): HasMany
    {
        return $this->hasMany(Classe::class);
    }
}
