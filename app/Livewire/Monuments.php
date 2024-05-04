<?php

namespace App\Livewire;

use App\Data\MonumentData;
use App\Models\Category;
use App\Models\Monument;
use App\Models\Municipality;
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

    private $monuments;

    private $city;

    public function mount(): void
    {
        $this->dispatch('change-municipality', code: $this->municipality)
            ->to(Search::class);
    }

    public function toggleView(): void
    {
        $this->view = $this->view == 'list' ? 'map' : 'list';
    }

    public function reloadMap(): void
    {
        if ($this->view !== 'map') return;

        $monuments = $this->getMonuments();

        if (!$monuments->count() && $this->municipality)
            $this->city = Municipality::where('istat_code', $this->municipality)->first();

        $this->dispatch('reload-map', monuments: $monuments, city: $this->city);
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

    private function getMonuments() {
        return $this->monuments?->map(fn($monument) => MonumentData::fromModel($monument)) ?? collect();
    }

    public function render(): View
    {
        $categories = Category::with('media')
            ->has('monuments')
            ->withType('category')
            ->get();

        $this->monuments = Monument::query()
//            ->with('municipality') // TODO: with eager loading
            ->when($this->municipality, function ($q) {
                return $q->whereHas('municipality', function ($q) {
                    return $q->where('istat_code', $this->municipality);
                });
            })
            ->when($this->category, function ($q) {
                return $q->withAnyTags([$this->category], 'category');
            })
            ->orderBy('slug')
            ->get();

        $monuments = $this->getMonuments();

        $this->reloadMap();

        return view('livewire.monuments',
            compact(['categories', 'monuments'])
        )->title(__('monuments.title'));
    }
}
