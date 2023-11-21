<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Monument;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class Monuments extends Component
{
    #[Url(as: 'v')]
    public string $view = 'list';

    #[Url(as: 'c')]
    public string $category = '';

    #[Url(as: 'm')]
    public ?string $municipality = '';

    public function mount(): void
    {
        $this->dispatch('change-municipality', code: $this->municipality)
            ->to(Search::class);
    }

    public function toggleView(): void
    {
        $this->view = $this->view == 'list' ? 'map' : 'list';
    }

    #[On('change-category')]
    public function changeCategory($category): void
    {
        $this->category = $category;
    }

    #[On('change-municipality')]
    public function changeMunicipality($code)
    {
        $this->municipality = $code;
    }

    public function render(): View
    {
        $categories = Category::has('monuments')->get();

        $monuments = Monument::query()
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

        if ($this->view == 'map') {
            $this->dispatch('reload-map', monuments: $monuments);
        }

        return view('livewire.monuments',
            compact(['monuments', 'categories'])
        )->title('Statue');
    }
}
