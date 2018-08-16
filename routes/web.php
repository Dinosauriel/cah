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

//MARK: -- GAME RESOURCE
Route::get('/games/', 'GameController@index')->name('listGames');
Route::get('/games/{gameId}', 'GameController@show')->name('viewGame');