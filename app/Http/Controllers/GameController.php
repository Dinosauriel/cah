<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Events\Game\GameDeleted;
use App\Game;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('games.lobby');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $game = new Game([
			'name' => $request->user()->username . 's Game'
        ]);
        $game->public_id = static::generateNewPublicId();

        $game = $request->user()->createGame($game);

        return response()->json([
            'message' => 'game creation successful',
            'redirect' => $game->getRoute(),
            'content' => $game
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {	
        if ($game->status == 'draft') {
            return view('games.edit', [
                'game' => $game,
            ]);
        }

        return view('games.play', [
            'game' => $game,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        //validate
		$validator = Validator::make($request->all(), [
			'content.points_required' => 'sometimes|integer|gt:0|lt:20',
			'content.name' => 'sometimes|min:1|max:24'
        ])->validate();
        
        if (!empty($request->input('content.name'))) {
            $game->name = $request->input('content.name');
        }

        if (!empty($request->input('content.points_required'))) {
            $game->points_required = $request->input('content.points_required');
        }

        $game->save();

        return response()->json([
            'message' => 'game successfully updated'
        ], 200);
    }

    /**
     * Remove the specified game from storage.
     *
     * @param  Game  $game
     */
    public static function deleteGame(Game $game)
    {
        //remove all players
        $game->playerRelations()->delete();

        $game->delete();

        //event(new GameDeleted($game));
    }

    public static function generateNewPublicId()
    {
        return static::getRandomBase64String(12);
    }
    
	/**
	 * generates cryptographically random base64 string of desired length, suitable for URLs
	 * @param $ofLength : the length of the desired string
	 *
	 * @return string of desired length
	 */
    public static function getRandomBase64String(int $ofLength): string
    {
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
