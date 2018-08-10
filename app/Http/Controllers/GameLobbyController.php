<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;

class GameLobbyController extends Controller
{
    public function index()
    {
        $games = Game::all();
        return view('games.lobby', [
            'games' => $games
        ]);
    }
}
