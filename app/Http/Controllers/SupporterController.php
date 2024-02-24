<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Supporter;
use Illuminate\View\View;

class SupporterController extends Controller
{
    public function __invoke(): View
    {
        $supporters = Supporter::all()
            ->sortBy('full_name')
            ->groupBy('type')
            ->sortKeysDesc();

        $schools = School::has('classes.monuments')
            ->with('municipality')
            ->get();

        return view('supporters',
            compact('supporters', 'schools')
        );
    }
}
