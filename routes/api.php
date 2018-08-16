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

Route::get('/player', function (Request $request) {
    return json_encode($request);
})->name('api_player');

Route::post('/login', 'LoginController@login')->name('api_login');
Route::post('/logout', 'LoginController@logout')->name('api_logout');

Route::get('/games/', 'GameController@jsonIndex')->name('api_listGames');
//create a new game
Route::post('/games', 'GameController@store')->name('api_storeGame');
//update the game
Route::patch('/games/{gameId}', 'GameController@update')->name('api_updateGame');
//delete the game
Route::delete('/games/{gameId}', 'GameController@destroy')->name('api_destroyGame');
