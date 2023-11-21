<?php

namespace App\Http\Controllers;

use App\Models\Monument;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MonumentController extends Controller
{
    public function show(Monument $monument)
    {
        // to fix: maybe create a local scope in character model
        $characters = $monument->characters
            ->filter(fn ($c) => !empty($c->description));

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
            'characters' => $characters,
            'next' => $next ?? $city_monuments->first(),
            'previous' => $previous ?? $city_monuments->last()
        ]);
    }
}
