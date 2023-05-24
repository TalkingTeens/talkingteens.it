<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Document;

class DocumentController extends Controller
{
    public function __invoke(): View
    {
        $documents = Document::active()->get()
            ->groupBy('category');

        return view('documents',
            compact('documents')
        );
    }
}
