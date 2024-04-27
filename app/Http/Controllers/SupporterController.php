<?php

namespace App\Http\Controllers;

use App\Models\Supporter;
use Illuminate\View\View;

class SupporterController extends Controller
{
    public function __invoke(): View
    {
        // TODO: add DTO
        $supporters = Supporter::all()
            ->sortBy('full_name')
            ->groupBy('type')
            ->sortKeysDesc();

        return view('supporters',
            compact('supporters')
        );
    }
}
