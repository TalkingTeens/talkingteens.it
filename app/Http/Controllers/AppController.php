<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AppController extends Controller
{
    public function __invoke(Request $request)
    {
        $ua = $request->header('User-Agent');

        if (Str::contains($ua, ["iPod", "iPhone", "iPad"])) {
            return redirect()->away('https://apps.apple.com/it/app/talking-teens/id1459498571');
        }
        
        if (Str::contains($ua, "Android")) {
            return redirect()->away('https://play.google.com/store/apps/details?id=digital.diapason.echo.talkingteens');
        }

        return view('app');
    }
}
