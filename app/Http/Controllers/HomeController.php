<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Monument;
use App\Models\Municipality;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $monuments = Monument::inRandomOrder()->limit(3)->get();

        $articles = Article::all()->sortBy('order');

        $municipalities = Municipality::has('monuments')
            ->pluck('name');

        return view('home',
            compact(['monuments', 'articles', 'municipalities'])
        );
    }
}
