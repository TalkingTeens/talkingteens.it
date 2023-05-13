<?php

namespace App\Http\Livewire\Document;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class Download extends Component
{
    public $document;

    public function mount($document)
    {
        $this->document = $document;
    }

    public function download()
    {
        $this->document
            ->increment('downloads');

        return Storage::disk('public')
            ->download(
                $this->document->resource,
                $this->document->filename
            );
    }

    public function render()
    {
        return view('livewire.document.download');
    }
}