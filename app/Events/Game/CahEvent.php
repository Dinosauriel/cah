<?php

namespace App\Events\Game;

use App\Game;
use App\Player;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class CahEvent
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
    public function __construct(Game $game)
    {
        $this->game = $game;
	}
	
	/**
     * Create a new event instance.
     *
     * @return void
     */
    public static function withPlayer(Game $game, Player $player)
    {
		$event = new CahEvent($game);
		$event->player = $player;
    }
}