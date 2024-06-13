<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Lang;
use Livewire\Component;

class Donate extends Component
{
    public function render()
    {
        $faqs = Lang::get('donate.faq.questions');

        return view('livewire.donate', compact('faqs'))
            ->title(__('donate.title'));
    }
}
