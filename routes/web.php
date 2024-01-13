<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CountryController;

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

Route::get('/' , [FrontendController::class , 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::controller(CountryController::class)->prefix('admin')->name('country.')->group(function () {

    // Country
    Route::get('country' , 'index')->name('index');
    Route::get('country/list' , 'list')->name('list');
    Route::post('country/post', 'store')->name('store');
    Route::get('/{country}', 'show')->name('show');
    Route::post('/{country}', 'update')->name('update');
    Route::delete('/{country}', 'delete')->name('delete');
});
