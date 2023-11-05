<?php

namespace App\Livewire\Document;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class File extends Component
{
    public $document;

    public function mount($document)
    {
        $this->document = $document;
    }

    private function getSize(): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];

        $bytes = Storage::disk('public')
            ->size($this->document->resource);

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    private function getType(): string
    {
        $mime_type = Storage::disk('public')
            ->mimeType($this->document->resource);

        $type = Str::before($mime_type, '/');

        return in_array($type, ['video', 'image']) ? $type : 'file';
    }

    public function open()
    {
        $this->document
            ->increment('opened');
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
        return view('livewire.document.file', [
            'size' => $this->getSize(),
            'type' => $this->getType()
        ]);
    }
}
