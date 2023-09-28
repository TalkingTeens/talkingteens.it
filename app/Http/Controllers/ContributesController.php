<?php

namespace App\Http\Controllers;

use App\Models\Supporter;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Sponsor;

class ContributesController extends Controller
{
    public function __invoke(): View
    {
        $sponsors = Sponsor::all()
            ->sortBy('order');

        $supporters = Supporter::all()
            ->sortBy('full_name');

        return view('contributes',
            compact('sponsors', 'supporters')
        );
    }
}
