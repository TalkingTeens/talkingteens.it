<?php

namespace App\Services;

use App\Models\Redirect;
use Spatie\MissingPageRedirector\Redirector\Redirector;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Str;

class RedirectService implements Redirector
{
    public function getRedirectsFor(Request $request): array
    {
        $host = Str::replaceStart('www.', '', $request->getHost());
        $subdomain = Str::remove('.', Str::before($host, config('app.domain')));

        $db_redirects = Redirect::where('subdomain', $subdomain ?: null)
            ->get()
            ->flatMap(fn($redirect) => [$redirect->from => $redirect->to])
            ->toArray();

        $config_redirects = config('missing-page-redirector.redirects');

        return array_merge($db_redirects, $config_redirects);
    }
}
