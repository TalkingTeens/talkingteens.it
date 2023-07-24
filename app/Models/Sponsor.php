<?php

namespace App\Models;

use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'resource',
        'visible',
        'order',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new ActiveScope);
    }

}
