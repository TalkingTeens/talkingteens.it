<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Document;

class DocumentController extends Controller
{
    public function __invoke(): View
    {
        $categories = Document::with('media')
            ->get(['id', 'title', 'category'])
            ->groupBy('category');

        return view('documents',
            compact('categories')
        );
    }
}
