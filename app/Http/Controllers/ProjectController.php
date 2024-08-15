<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function __invoke(): View
    {
        $posts = Post::all();

        return view('project',
            compact('posts')
        );
    }
}
