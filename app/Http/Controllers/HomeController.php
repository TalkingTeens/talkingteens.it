<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Municipality;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $articles = Article::all();
        $municipalities = Municipality::has('monuments')
            ->pluck('name');

        return view('home',
            compact(['articles', 'municipalities'])
        );
    }
}
