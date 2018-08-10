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

Route::get('/', 'AdminLoginController@index');
Route::get('/games/', 'GameLobbyController@index');

Route::patch('/games/{gameId}/update', 'GameController@updateGame');
Route::get('/games/create', 'GameController@createGame');
Route::get('/games/{gameId}', 'GameController@index');