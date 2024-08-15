<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Lang;
use Livewire\Attributes\Url;
use Livewire\Component;

class Donate extends Component
{
    #[Url(as: 'm')]
    public string $method = 'card';

    public function render()
    {
        $faqs = Lang::get('donate.faq.questions');

        return view('livewire.donate', compact('faqs'))
            ->title(__('donate.title'));
    }
}
