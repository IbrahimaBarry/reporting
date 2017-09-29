<?php

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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/historique', 'HomeController@historique')->name('home.historique');
Route::get('/home/search', 'HomeController@search')->name('home.search');

Route::middleware(['auth'])->group(function () {
    Route::resource('users', 'UserController')->middleware('isAdmin');
    Route::get('/users/search', 'UserController@search')->name('users.search')->middleware('isAdmin');

    Route::resource('projets', 'ProjetController')->middleware('isAdmin');
    Route::get('/projets/completed/{projet}', 'ProjetController@completed')->name('projets.completed')->middleware('isAdmin');
    Route::get('/projets/search', 'ProjetController@search')->name('posts.search')->middleware('isAdmin');

    Route::put('/lots/update', 'LotController@update')->middleware('isAdmin');
    Route::post('/lots', 'LotController@complete')->name('lots.complete');
    Route::put('/lots/{lot}', 'LotController@uncomplete')->name('lots.uncomplete')->middleware('isAdmin');
    Route::post('/lots/save', 'LotController@save')->name('lots.save');
});
