<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Document;

class DocumentController extends Controller
{
    public function __invoke(): View
    {

        $categories = Document::all('id', 'title', 'category', 'resource', 'picture', 'filename')
            ->groupBy('category');

        return view('documents',
            compact('categories')
        );
    }
}
