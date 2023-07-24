<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Webcall extends Model
{
    use HasFactory;

    protected $casts = [
        'resources' => 'array',
    ];

    protected $fillable = [
        'resources',
    ];
}
