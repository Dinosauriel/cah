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

//login with the credentials
Route::post('/login', 'LoginController@login')->name('api_login');
//log out
Route::post('/logout', 'LoginController@logout')->name('api_logout')->middleware('auth:api');

//create a new game
Route::post('/games/store', 'GameController@store')->name('api_storeGame')->middleware('auth:api')->middleware('can:store,App\Game');
//update the game
Route::patch('/games/{game}', 'GameController@update')->name('api_updateGame')->middleware('auth:api')->middleware('can:update,game');
//delete the game
Route::delete('/games/{game}', 'GameController@destroy')->name('api_destroyGame')->middleware('auth:api')->middleware('can:destroy,game');
