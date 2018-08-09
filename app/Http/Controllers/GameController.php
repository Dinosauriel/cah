<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Game;

class GameController extends Controller
{
    public function index($gameId)
    { 
        $game = Game::publicId($gameId)->first();
        dd($game);
        return view('games.play');
    }
}
