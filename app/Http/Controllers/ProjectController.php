<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ProjectController extends Controller
{
    public function __invoke(): View
    {
        return view('project');
    }
}
