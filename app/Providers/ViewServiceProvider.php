<?php

namespace App\Providers;

use App\Models\Municipality;
use Illuminate\Support\Facades;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Facades\View::composer([
            'components.ui.dropdown.search', 'livewire.search'
        ], function (View $view) {
            $view->with('municipalities', Municipality::has('monuments')
                ->with('province.region')
                ->get());
        });
    }
}
