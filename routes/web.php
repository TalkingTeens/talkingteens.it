<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\StatueController;
use App\Http\Controllers\ContributesController;
use App\Http\Livewire\Donate;

Route::group(
[
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
],
function() {

    // Home
    Route::get('/', HomeController::class)->name('home');
    Route::get('app', AppController::class)->name('app');
    Route::get('didactics', DocumentController::class)->name('docs');
    Route::get('donate', Donate::class)->name('donate');
    Route::get('contributes', ContributesController::class)->name('supporters');

    Route::view('privacy', 'privacy')->name('privacy');

    Route::resource('statues', StatueController::class)->only(['index', 'show']);

});
