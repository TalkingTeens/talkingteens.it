<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $articles = Article::all();

        return view('home',
            compact('articles')
        );
    }
}
