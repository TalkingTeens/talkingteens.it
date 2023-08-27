<?php

namespace App\Livewire\Monuments;

use App\Models\Category;
use App\Models\Monument;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class Index extends Component
{
    #[Url(as: 'v')]
    public string $view = 'list';

    #[Url(as: 'c')]
    public string $category = '';

    #[Url(as: 'm')]
    public ?string $municipality = '';

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
        )->title('Statue');
    }
}
