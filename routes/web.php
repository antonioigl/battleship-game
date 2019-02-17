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
    Route::get('/ships/play', 'ShipController@play')->name('ships.play');
    Route::get('/ships/game-over', 'ShipController@gameOver')->name('ships.gameOver');
    Route::post('/shots', 'ShotController@store')->name('shots.store');
    Route::get('/ships/my-ships', 'ShipController@myShips')->name('ships.myShips');
    Route::get('/shots/my-shots', 'ShotController@myShots')->name('shots.myShots');
});
