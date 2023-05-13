<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'category',
        'picture',
        'resource',
        'visible',
        'filename',
    ];

    public function scopeActive(Builder $query): void
    {
        $query->where('visible', 1);
    }
}