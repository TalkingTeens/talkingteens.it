<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Monument;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

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

//        $previous = $city_monuments
//            ->where('id', '<', $monument->id)
//            ->sortByDesc('id')
//            ->first();

        $phone_number = '+39'.Str::remove(' ', $monument->phone_number);

        // dd($monument->classes);

        return view('monuments.show', [
            'monument' => $monument,
            'pin' => $monument->getFirstMedia('map')?->getUrl('pin'),
            'phone_number' => $phone_number,
            'tags' => $tags,
            'characters' => $characters,
            'share' => [
                'url' => rawurlencode(Request::url()),
                'text' => rawurlencode(
                    __('monument.share.text', [
                        'monument' => $monument->name,
                        'municipality' => $monument->municipality->name
                    ])
                ),
            ],
            'next' => $next ?? $city_monuments->first(),
//            'previous' => $previous ?? $city_monuments->last()
        ]);
    }
}
