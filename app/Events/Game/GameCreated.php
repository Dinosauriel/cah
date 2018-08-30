<?php

namespace App\Events\Game;

use App\Events\CahEvent;

class GameCreated extends CahEvent
{
    public static $identifier = 'game_created';

    protected function evaluateTargetPlayers()
    {
        return Game::Admins()->get();
    }
}
