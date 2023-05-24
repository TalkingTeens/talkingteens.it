<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Sponsor;

class ContributesController extends Controller
{
    public function __invoke(): View
    {
        $sponsors = Sponsor::all();

//        dd($sponsors);

        return view('contributes',
            compact('sponsors')
        );
    }
}
