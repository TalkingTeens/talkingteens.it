<?php

namespace App\Http\Controllers;

use App\Models\Monument;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MonumentController extends Controller
{
    public function show(Monument $monument)
    {
        return view('monuments.show',
            compact('monument')
        );
    }
}
