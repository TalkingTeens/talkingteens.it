<?php

namespace App\Livewire\Document;

use Illuminate\Support\Str;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class File extends Component
{
    public $document;
    public ?Media $media;

    public function mount($document)
    {
        $this->document = $document;
        $this->media = $document->getFirstMedia('didactics');
    }

    public function open()
    {
        $this->document->increment('opened');
    }

    public function download()
    {
        $this->document->increment('downloads');

        // TODO: download with title
        return $this->media;
    }

    public function render()
    {
        return view('livewire.document.file', [
            'type' => $this->getType()
        ]);
    }

    private function getType(): string
    {
        $type = Str::before($this->media?->mime_type, '/');

        return in_array($type, ['video', 'image']) ? $type : 'file';
    }
}
