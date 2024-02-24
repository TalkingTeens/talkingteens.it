<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\SupporterController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MonumentController;
use App\Http\Controllers\SponsorController;
use App\Livewire\Monuments;
use App\Livewire\Webcall;
use Illuminate\Support\Facades\Route;

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

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::get('/', HomeController::class)->name('home');
        Route::get('app', AppController::class)->name('app');
        Route::get('didattica', DocumentController::class)->name('docs');
        Route::get('sostenitori', SupporterController::class)->name('supporters');
        Route::get('sponsor', SponsorController::class)->name('sponsors');
        Route::view('dona', 'donate')->name('donate');
        // Route::view('progetto', 'project')->name('project');
        // Route::view('echo', 'echo')->name('echo');
        Route::get('webcall/{monument}', Webcall::class)->name('call');
        Route::get('statue/{monument}', [MonumentController::class, 'show'])->name('monuments.show');
        Route::get('statue', Monuments::class)->name('monuments.index');
        Route::get('autori/{author}', [AuthorController::class, 'show'])->name('authors.show');

        Route::view('privacy-policy', 'privacy')->name('privacy');
        Route::view('cookie-policy', 'cookie')->name('cookie');

        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/livewire/update', $handle);
        });
    });
