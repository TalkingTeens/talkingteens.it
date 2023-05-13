<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Route;

Route::group(
[
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeCookieRedirect', 'localizationRedirect', 'localeViewPath' ]
],
function() {
    
    // Home
    Route::get('/', HomeController::class)->name('home');
    Route::get('didattica', DocumentController::class)->name('docs');

});