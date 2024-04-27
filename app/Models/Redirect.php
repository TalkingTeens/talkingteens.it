<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Redirect extends Model
{
    use HasFactory;

    protected $fillable = [
        'from',
        'to',
    ];

    public static function boot()
    {
        parent::boot();

        static::saved(function () {
            Cache::forget('redirect_cache_routes');
        });
    }
}
