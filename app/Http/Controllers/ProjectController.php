<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Lang;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function __invoke(): View
    {
        $posts = Post::all()
            ->sortBy('order');

        $goals = Lang::get('project.goals.items');

        return view('project',
            compact('posts', 'goals')
        );
    }
}
