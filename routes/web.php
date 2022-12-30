<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('url.index');
});

Route::controller(UrlController::class)
    ->prefix('url')
    ->name('url.')
    ->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('short', 'create')->name('create');
        Route::post('short', 'store');
    });
