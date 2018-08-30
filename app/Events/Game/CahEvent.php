<?php

namespace App\Events\Game;

use App\Game;
use App\Player;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

abstract class CahEvent
{
	use SerializesModels, Dispatchable;
	
	public $game;
	public $player;
	public static $identifier;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Game $game, Player $player = null)
    {
        $this->player = player;
        $this->game = $game;
	}
}