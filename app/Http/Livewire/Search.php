<?php

namespace App\Http\Livewire;

use App\Models\Municipality;
use Illuminate\View\View;
use Livewire\Component;

class Search extends Component
{
    public ?string $municipality = null;

    protected $queryString = [
        'municipality' => ['as' => 'm'],
    ];

    public function setMunicipality($code = null): void
    {
        $this->municipality = $code;
    }

    public function render(): View
    {
        $municipalities = Municipality::has('monuments')
            ->with('province.region')
            ->get();

        return view('livewire.search', compact([
            'municipalities'
        ]));
    }
}
