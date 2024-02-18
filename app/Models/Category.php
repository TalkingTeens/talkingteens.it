<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\Tags\Tag;

class Category extends Tag
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tags';

    protected $fillable = [
        'name',
        'slug',
        'type',
        'order_column',
//        'icon',
    ];

    public function monuments(): MorphToMany
    {
        return $this->morphedByMany(Monument::class, 'taggable', 'taggables', 'tag_id');
    }
}
