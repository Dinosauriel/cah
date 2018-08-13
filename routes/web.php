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

Route::get('/', 'LoginController@showAdminLogin')->name('adminLogin');
Route::get('/login', 'LoginController@showLogin')->name('login');
Route::post('/login', 'LoginController@login')->name('ajax_login');
Route::post('/logout', 'LoginController@logout')->name('ajax_logout');

//MARK: -- GAME RESOURCE
Route::get('/games/', 'GameController@index')->name('listGames');
Route::get('/games/{gameId}', 'GameController@show')->name('viewGame');

//create a new game
Route::post('/games', 'GameController@store')->name('ajax_storeGame');
//update the game
Route::patch('/games/{gameId}', 'GameController@update')->name('ajax_updateGame');
//delete the game
Route::delete('/games/{gameId}', 'GameController@destroy')->name('ajax_destroyGame');