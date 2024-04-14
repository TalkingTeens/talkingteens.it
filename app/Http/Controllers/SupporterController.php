<?php

namespace App\Http\Controllers;

use App\Data\SchoolData;
use App\Models\School;
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

        $schools = School::has('classes.monuments')->get()
            ->map(fn ($school) => SchoolData::fromModel($school));

        return view('supporters',
            compact('supporters', 'schools')
        );
    }
}
