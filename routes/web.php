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
    return view('admin_login');
});

Route::get('/games/', function () {
    $games = DB::table('games')->get();
    foreach ($games as $game) {
        dump($game);
    }
    return view('games.lobby');
});

Route::get('/games/{gameId}', function ($gameId) {
    
    $game = DB::table('games')->where('public_id', $gameId)->first();

    dd($game);

    return view('games.play');
});
