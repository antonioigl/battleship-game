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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/ships/create', 'ShipController@create')->name('ships.create');
    Route::post('/shots', 'ShotController@store')->name('shots.store');
    Route::get('/my-ships', 'ShipController@myShips')->name('ship.myShips');
    Route::get('/my-shots', 'ShotController@myShots')->name('shot.myShots');
});
