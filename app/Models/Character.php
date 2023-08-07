<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Character extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'name',
        'picture',
        'birth_year',
        'death_year',
        'description',
    ];

    public $translatable = [
//        'name',
        'description',
    ];
}
