<?php

namespace App\Livewire;

use App\Models\Municipality;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Attributes\On;

class Search extends Component
{
    public $municipalities;
    public ?string $label = null;

    #[On('change-municipality')]
    public function setLabel($code)
    {
        $municipality = Municipality::where('istat_code', $code)
            ->first();

        $this->label = $municipality ? $municipality->getDisplayName() : null;
    }

    public function render(): View
    {
        return view('livewire.search');
    }
}
