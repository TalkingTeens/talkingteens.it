<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\Tag;

class Category extends Tag implements HasMedia
{
    use HasFactory, InteractsWithMedia;

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
    ];

    public function monuments(): MorphToMany
    {
        return $this->morphedByMany(Monument::class, 'taggable', 'taggables', 'tag_id');
    }
}
