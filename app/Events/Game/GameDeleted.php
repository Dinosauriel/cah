<?php

namespace App\Events\Game;

use App\Events\CahEvent;

class GameDeleted extends CahEvent
{
    public static $identifier = 'game_deleted';

    protected function evaluateTargetPlayers()
    {
        return Game::Admins()->get();
    }
}
