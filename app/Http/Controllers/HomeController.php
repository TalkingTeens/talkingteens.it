<?php

namespace App\Http\Controllers;

use App\Data\ArticleData;
use App\Data\MonumentData;
use App\Data\SponsorData;
use App\Models\Article;
use App\Models\Monument;
use App\Models\Municipality;
use App\Models\Sponsor;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $monuments = Monument::inRandomOrder()
//            ->with('municipality')  // TODO: with eager loading
            ->limit(3)
            ->get()
            ->map(fn($monument) => MonumentData::fromModel($monument));

        $articles = Article::with('media')
            ->get()
            ->sortBy('order')
            ->map(fn($article) => ArticleData::fromModel($article));

        $municipalities = Municipality::has('monuments')
            ->pluck('name');

        $sponsors = Sponsor::with('media')
            ->get()
            ->sortBy('order')
            ->map(fn($sponsor) => SponsorData::fromModel($sponsor));

        return view('home',
            compact(['monuments', 'articles', 'municipalities', 'sponsors'])
        );
    }
}
