<?php

namespace App\Http\Livewire\Monuments;

use App\Models\Category;
use App\Models\Monument;
use Illuminate\View\View;
use Livewire\Component;

class Index extends Component
{
    public string $view = 'list';
    public string $category = '';
    public ?string $municipality = null;

    protected $queryString = [
        'view' => ['except' => 'list', 'as' => 'v'],
        'category' => ['except' => '', 'as' => 'c'],
        'municipality' => ['as' => 'm'],
    ];

    protected $listeners = ['changeMunicipality', 'changeCategory'];

    public function toggleView(): void
    {
        $this->view = $this->view == 'list' ? 'map' : 'list';
    }

    public function changeCategory($category = null): void
    {
        $this->category = $category;
        $this->dispatchBrowserEvent('name-updated');
    }

    public function changeMunicipality($code)
    {
        $this->municipality = $code;
    }

    public function render(): View
    {
        $categories = Category::has('monuments')->get();

        $monuments = Monument::with('municipality')
            ->when($this->municipality, function ($q) {
                return $q->whereHas('municipality', function($q) {
                    return $q->where('istat_code', $this->municipality);
                });
            })
            ->when($this->category, function ($q) {
                return $q->whereHas('categories', function($q) {
                    return $q->where('slug', $this->category);
                });
            })
            ->orderBy('slug')
            ->get();

        return view('livewire.monuments.index',
            compact(['monuments', 'categories'])
        );
    }
}
