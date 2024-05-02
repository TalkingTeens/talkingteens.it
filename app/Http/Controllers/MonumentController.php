<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Monument;

class MonumentController extends Controller
{
    public function show(Monument $monument)
    {
        // TODO: maybe create a local scope in character model
        $characters = $monument->characters
            ->filter(fn($c) => !empty($c->description));

        $tags = $monument->categories->sortBy('order_column')
            ->filter(fn(Category $tag) => $tag->name && $tag->slug);

        $city_monuments = Monument::ofMunicipality($monument->municipality_code)
            ->get()
            ->except($monument->id);

        $next = $city_monuments
            ->where('id', '>', $monument->id)
            ->sortBy('id')
            ->first();

        $previous = $city_monuments
            ->where('id', '<', $monument->id)
            ->sortByDesc('id')
            ->first();

        return view('monuments.show', [
            'monument' => $monument,
            'pin' => $monument->webcall?->getFirstMedia('webcalls')?->getFullUrl(),
            'tags' => $tags,
            'characters' => $characters,
            'next' => $next ?? $city_monuments->first(),
            'previous' => $previous ?? $city_monuments->last()
        ]);
    }
}
