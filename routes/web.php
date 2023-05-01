<?php


use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::group(
[
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeCookieRedirect', 'localizationRedirect', 'localeViewPath' ]
],
function() {
    
    // Home
    Route::get('/', HomeController::class)->name('home');

});