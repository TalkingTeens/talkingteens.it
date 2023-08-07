<?php

namespace App\Http\Livewire;

use App\Models\Municipality;
use Illuminate\View\View;
use Livewire\Component;

class Search extends Component
{
    public ?string $municipality = null;
    public ?string $label = null;

    public function syncMunicipality($code = null)
    {
        $this->emitTo('monuments.index','changeMunicipality', $code);

        $this->setMunicipality($code);
    }

    public function setMunicipality($code = null)
    {
        $this->municipality = $code;

        $this->setLabel($code);
    }

    public function setLabel($code)
    {
        $municipality = Municipality::where('istat_code', $code)
            ->first();

        $this->label = $municipality ? $municipality->name . ', ' . $municipality->province->region->name : null;
    }

    public function render(): View
    {
        return view('livewire.search');
    }
}
