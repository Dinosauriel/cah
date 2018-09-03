<?php

namespace App\Events\Game;

use App\Game;
use App\Player;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

abstract class CahEvent implements Jsonable
{
	use SerializesModels, Dispatchable;
    
    //game most closely associated with this action
    public $game;
    //player most closely associated with this action
    public $player;
    //array of players to whom this action should be pushed
    public $targetPlayers;
    //unique, human readable identifier of this event
	public static $identifier;

    /**
     * Create a new event instance.
     * @param $player: the player that performed the action
     * @param $game: the game associated with this event
     * 
     * @return void
     */
    public function __construct(Game $game, Player $player = null)
    {
        $this->player = $player;
        $this->game = $game;
        $this->targetPlayers = $this->evaluateTargetPlayers();
    }

    public function toJson($options = 0)
    {
        $data = [
            'event' => static::$identifier,
            'game' => $this->game,
        ];

        if (!empty($this->player)) {
            $data['player'] = $this->player;
        }

        return json_encode($data);
    }
    
    protected abstract function evaluateTargetPlayers();
}