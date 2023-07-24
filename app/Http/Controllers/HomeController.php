<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $sponsors = Sponsor::all();

        return view('home',
            compact('sponsors')
        );
    }
}
