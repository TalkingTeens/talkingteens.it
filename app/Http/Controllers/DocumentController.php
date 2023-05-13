<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\View\View;

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
