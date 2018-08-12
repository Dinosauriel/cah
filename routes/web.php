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

Route::get('/', 'AdminLoginController@index')->name('root');
Route::post('/', 'AdminLoginController@login')->name('login');

Route::get('/games/', 'GameController@list')->name('listGames');
Route::get('/games/create', 'GameController@store')->name('storeGame');
Route::patch('/games/{gameId}/update', 'GameController@update')->name('updateGame');
Route::get('/games/{gameId}/delete', 'GameController@delete')->name('deleteGame');
Route::get('/games/{gameId}', 'GameController@index')->name('viewGame');