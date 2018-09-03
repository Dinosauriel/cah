<?php

namespace App\Events\Game;

use App\Events\Game\CahEvent;

class GameCreated extends CahEvent
{
    public static $identifier = 'game_created';

    protected function evaluateTargetPlayers()
    {
        return Game::Admins()->get();
    }
}
