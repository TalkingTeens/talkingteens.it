<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class LegalController extends Controller
{
    private const IUBENDA_POLICIES = [
        'it' => '83254445',
        'en' => '53687330',
    ];

    public function __invoke()
    {
        $type = Route::currentRouteName();

        $policy = $this->getPolicy($type);

        return view('legal', compact('type', 'policy'));
    }

    private function getPolicy($type): string
    {
        $locale = LaravelLocalization::getCurrentLocale();

        $params[] = $type === 'terms' ? 'termini-e-condizioni' : 'privacy-policy';

        $params[] = self::IUBENDA_POLICIES[$locale];

        if ($type === 'cookie') {
            $params[] = 'cookie-policy';
        }

        $url = 'https://www.iubenda.com/api/'.Arr::join($params, '/').'/no-markup';

        return Cache::remember("{$type}:{$locale}", 60 * 60 * 24, function () use ($url) {
            return Http::get($url)['content'] ?? '';
        });
    }
}
