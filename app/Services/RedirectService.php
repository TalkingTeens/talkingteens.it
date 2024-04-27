<?php

namespace App\Services;

use App\Models\Redirect;
use Spatie\MissingPageRedirector\Redirector\Redirector;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Cache;

class RedirectService implements Redirector
{
    public function getRedirectsFor(Request $request): array
    {
        // Get from the database and remember forever
        // we clear this on model created and updated
        $db_redirects = Cache::rememberForever('redirect_cache_routes', function () {
            return Redirect::all()->flatMap(function ($redirect) {
                return [$redirect->from => $redirect->to];
            })->toArray();
        });

        // Get the redirects from the config
        $config_redirects = config('missing-page-redirector.redirects');

        // Merge both values
        return array_merge($db_redirects, $config_redirects);
    }
}
