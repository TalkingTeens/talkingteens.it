<?php

namespace App\Models;

use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supporter extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'type',
        'visible'
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new ActiveScope);
    }
}
