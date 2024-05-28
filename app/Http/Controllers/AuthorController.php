<?php

namespace App\Http\Controllers;

use App\Data\MonumentData;
use App\Models\Author;

class AuthorController extends Controller
{
    public function show(Author $author)
    {
        $author->load('media', 'monuments.media');

        $monuments = $author->monuments->map(fn($monument) => MonumentData::fromModel($monument));

        return view('authors.show',
            compact(['author', 'monuments'])
        );
    }
}
