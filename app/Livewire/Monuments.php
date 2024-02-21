<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Monument;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Spatie\Tags\Tag;

class Monuments extends Component
{
    #[Url(as: 'v')]
    public string $view = 'list';

    #[Url(as: 'c')]
    public string $category = '';

    #[Url(as: 'm')]
    public ?string $municipality = '';

    public $monuments;

    public function mount(): void
    {
        $this->dispatch('change-municipality', code: $this->municipality)
            ->to(Search::class);
    }

    public function toggleView(): void
    {
        $this->view = $this->view == 'list' ? 'map' : 'list';

        $this->reloadMap();
    }

    public function reloadMap(): void
    {
        if ($this->view !== 'map') return;

        $this->dispatch('reload-map', monuments: $this->monuments);
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
        $categories = Category::has('monuments')->withType('category')->get();

        $this->monuments = Monument::query()
            ->when($this->municipality, function ($q) {
                return $q->whereHas('municipality', function($q) {
                    return $q->where('istat_code', $this->municipality);
                });
            })
            ->when($this->category, function ($q) {
                return $q->whereHas('categories', function($q) {
                    return $q->withType('category')->containing($this->category);
                });
            })
            ->orderBy('slug')
            ->get();

        $this->reloadMap();

        return view('livewire.monuments',
            compact(['categories'])
        )->title('Statue');
    }
}
