<?php

namespace App\Http\Controllers;

use App\Data\SchoolData;
use App\Models\Post;
use App\Models\School;
use App\Models\Supporter;
use Illuminate\Support\Facades\Lang;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function __invoke(): View
    {
        $posts = Post::all()
            ->sortBy('order');

        $goals = Lang::get('project.goals.items');

        // TODO: add DTO
        $supporters = Supporter::all()
            ->sortBy('full_name')
            ->groupBy('type')
            ->sortKeysDesc();

        $schools = School::has('classes.monuments')->get()
            ->map(fn($school) => SchoolData::fromModel($school));

        return view('project',
            compact('posts', 'goals', 'supporters', 'schools')
        );
    }
}
