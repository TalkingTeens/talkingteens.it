<?php

namespace App\Http\Controllers;

use App\Models\Supporter;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Sponsor;

class SupporterController extends Controller
{
    public function __invoke(): View
    {
        $supporters = Supporter::all()
            ->sortBy('full_name')
            ->groupBy('type')
            ->sortKeysDesc();

        return view('supporters',
            compact('supporters')
        );
    }
}
