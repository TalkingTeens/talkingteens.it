<?php

namespace App\Http\Livewire\Document;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class File extends Component
{
    public $document;
    public $size;

    public function mount($document)
    {
        $this->document = $document;

        $this->getSize();
    }

    public function getSize(): void
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];

        $bytes = Storage::disk('public')
            ->size($this->document->resource);

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        $this->size = round($bytes, 2) . ' ' . $units[$i];
    }

    public function open()
    {
        $this->document
            ->increment('opened');
    }

    public function render()
    {
        return view('livewire.document.file');
    }
}
