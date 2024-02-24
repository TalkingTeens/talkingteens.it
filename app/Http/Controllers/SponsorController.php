<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\View\View;

class SponsorController extends Controller
{
    public function __invoke(): View
    {
        $sponsors = Sponsor::all()
            ->sortBy('order');

        return view('sponsors',
            compact('sponsors')
        );
    }
}
