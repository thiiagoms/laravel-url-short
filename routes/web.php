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
    // return view('welcome');
    return redirect()->route('urls.index');
});

Route::controller(UrlController::class)->prefix('urls')
    ->name('urls.')
    ->group(function () {

        Route::get('', 'index')->name('index');
        Route::get('short', 'create')->name('create');
        Route::post('short', 'store');
        Route::get('{short}', 'redirect')->name('redirect');
    });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
