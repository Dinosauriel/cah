<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Game;

class GameController extends Controller
{
	
	public function __construct()
	{
		$this->middleware('auth')->except(['index']);
	}

    public function index($gameId)
    { 
        $game = Game::publicId($gameId)->first();
        return view('games.edit', [
            'game' => $game,
        ]);
    }

    public function list()
    {
        $games = Game::all();

        return view('games.lobby', [
            'games' => $games,
        ]);
    }

    /* 
    Create a new Game with a new publicId from Scratch and Store it to the Database
    */
    public function store()
    {

		$game = auth()->user()->createGame(new Game([
			'public_id' => static::getRandomBase64String(11),
			'name' => 'New Game'
		]));

        return redirect($game->getDraftUrl());
    }

    /*
    Update an existing Game
    */
    public function update($gameId)
    {
        $this->validate(request(), [
            ''
        ]);

        dd(request()->all());
    }

    public function delete($gameId)
    {
        $game = Game::publicId($gameId)->first();
        $game->delete();

        return redirect(Game::getListUrl());
    }

    /**
	 * generates cryptographically random base64 string of desired length, suitable for URLs
	 * @param $ofLength : the length of the desired string
	 *
	 * @return string of desired length
	 */
	public static function getRandomBase64String(int $ofLength): string {
		$characters = [
			'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
			'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
			'0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '_', '-'
		];
		$string = '';
		for ($i = 0; $i < $ofLength; ++$i) {
			$string .= $characters[random_int(0, count($characters) - 1)];
		}
		return $string;
	}
}
