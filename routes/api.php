<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//retreive player info
Route::post('/player', 'PlayerController@jsonIndex')->name('api_player')->middleware('auth:api');

//login with the credentials
Route::post('/login', 'LoginController@login')->name('api_login');
//log out
Route::post('/logout', 'LoginController@logout')->name('api_logout')->middleware('auth:api');

//receive a listing of the games on this server
Route::get('/games', 'GameController@jsonIndex')->name('api_listGames')->middleware('auth:api')->middleware('can:list');
//create a new game
Route::post('/games', 'GameController@store')->name('api_storeGame')->middleware('auth:api')->middleware('can:create');
//update the game
Route::patch('/games/{gameId}', 'GameController@update')->name('api_updateGame')->middleware('auth:api')->middleware('can:update,gameId');
//delete the game
Route::delete('/games/{gameId}', 'GameController@destroy')->name('api_destroyGame')->middleware('auth:api')->middleware('can:delete,gameId');
