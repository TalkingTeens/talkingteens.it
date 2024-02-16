<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ContributesController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MonumentController;
use App\Livewire\Monuments;
use App\Livewire\Webcall;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
function() {
    Route::get('/', HomeController::class)->name('home');
    Route::get('app', AppController::class)->name('app');
    Route::get('didattica', DocumentController::class)->name('docs');
    Route::get('sostenitori', ContributesController::class)->name('contributes');
    Route::view('dona', 'donate')->name('donate');
    Route::view('progetto', 'project')->name('project');
    Route::view('echo', 'echo')->name('echo');
    Route::view('privacy-policy', 'privacy')->name('privacy');
    Route::view('cookie-policy', 'cookie')->name('cookie');
    Route::get('webcall/{monument}', Webcall::class)->name('call');
    Route::get('statue/{monument}', [MonumentController::class, 'show'])->name('monuments.show');
    Route::get('statue', Monuments::class)->name('monuments.index');
    Route::get('autori/{author}', [AuthorController::class, 'show'])->name('authors.show');

    Livewire::setUpdateRoute(function ($handle) {
        return Route::post('/livewire/update', $handle);
    });
});
