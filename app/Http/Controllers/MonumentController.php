<?php

namespace App\Http\Controllers;

use App\Models\Monument;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MonumentController extends Controller
{
    public function show(Monument $monument)
    {
//        $monument = $monument
//            ->with(['characters', 'municipality', 'authors', 'categories'])
//            ->get();

        // to fix: maybe create a local scope in character model
        $characters = $monument->characters
            ->filter(fn ($c) => !empty($c->description));

        return view('monuments.show',
            compact('monument', 'characters')
        );
    }
}
