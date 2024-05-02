<?php

namespace App\Http\Controllers;

use App\Data\SponsorData;
use App\Models\Sponsor;
use Illuminate\View\View;

class SponsorController extends Controller
{
    public function __invoke(): View
    {
        $sponsors = Sponsor::with('media')
            ->get()
            ->sortBy('order')
            ->map(fn($sponsor) => SponsorData::fromModel($sponsor));

        return view('sponsors',
            compact('sponsors')
        );
    }
}
