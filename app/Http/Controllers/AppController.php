<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class AppController extends Controller
{
    public function __invoke(): View
    {
        // $ua = $request->header('User-Agent');
        // if (stripos($ua, "iPod") || stripos($ua, "iPhone") || stripos($ua, "iPad"))
        // {
        //     return redirect()->away('https://apps.apple.com/it/app/talking-teens/id1459498571');
        // }
        // else if (stripos($ua, "Android"))
        // {
        //     return redirect()->away('https://play.google.com/store/apps/details?id=digital.diapason.echo.talkingteens');
        // }

        return view('app');
    }
}
