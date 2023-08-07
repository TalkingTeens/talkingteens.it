<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\MonumentController;
use App\Http\Controllers\ContributesController;
use App\Http\Livewire\Donate;
use App\Http\Livewire\Webcall;
use App\Http\Livewire\Monuments;

Route::group(
[
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
],
function() {

    Route::get('/', HomeController::class)->name('home');
    Route::get('app', AppController::class)->name('app');
    Route::get('didattica', DocumentController::class)->name('docs');
    Route::get('sostenitori', ContributesController::class)->name('contributes');
    Route::get('dona', Donate::class)->name('donate');
    Route::view('privacy-policy', 'privacy')->name('privacy');
    Route::get('webcall/{monument}', Webcall::class)->name('call');
    Route::get('statue/{monument}', [MonumentController::class, 'show'])->name('monuments.show');
    Route::get('statue', Monuments\Index::class)->name('monuments.index');

});
