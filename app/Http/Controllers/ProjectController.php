<?php

namespace App\Http\Controllers;

use App\Data\SchoolData;
use App\Models\School;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function __invoke(): View
    {
        $schools = School::has('classes.monuments')->get()
            ->map(fn ($school) => SchoolData::fromModel($school));

        return view('project',
            compact('schools')
        );
    }
}
