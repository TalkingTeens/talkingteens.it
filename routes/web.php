<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\MonumentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AboutController;
use App\Livewire\Donate;
use App\Livewire\Monuments;
use App\Livewire\Webcall;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\Health\Http\Controllers\SimpleHealthCheckController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('health', SimpleHealthCheckController::class);

Route::prefix('webhooks')->group(function () {
    Route::webhooks('mailchimp', 'webhook-sending-mailchimp', 'get'); // TODO: remove
    Route::webhooks('mailchimp', 'webhook-sending-mailchimp', 'post');
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        // WebCall
        Route::domain('call.'.config('app.domain'))->group(function () {
            Route::get('{monument}', Webcall::class)->name('call');
        });

        Route::domain(config('app.domain'))->group(function () {
            Route::get('/', HomeController::class)->name('home');
            Route::get('app', AppController::class)->name('app');
            Route::get('didattica', DocumentController::class)->name('docs');
            Route::get('dona', Donate::class)->name('donate');
            Route::get('autori/{author}', [AuthorController::class, 'show'])->name('authors.show');
            Route::get('progetto', ProjectController::class)->name('project');
            Route::get('chi-siamo', AboutController::class)->name('about');

            // Monuments
            Route::get('statue/{monument}', [MonumentController::class, 'show'])->name('monuments.show');
            Route::get('statue', Monuments::class)->name('monuments.index');

            // Legal
            Route::get('privacy-policy', LegalController::class)->name('privacy');
            Route::get('cookie-policy', LegalController::class)->name('cookie');
            Route::get('termini-e-condizioni', LegalController::class)->name('terms');
        });

        // Livewire
        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/livewire/update', $handle);
        });
    }
);
