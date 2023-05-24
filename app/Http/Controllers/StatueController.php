<?php

namespace App\Http\Controllers;

use App\Models\Statue;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StatueController extends Controller
{
    public function index(): View
    {
        $statues = Statue::all();

        return view('statues.index',
            compact('statues')
        );
    }

    public function show(Statue $statue)
    {
        return view('statues.show',
            compact('statue')
        );
    }
}
