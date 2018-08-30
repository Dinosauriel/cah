<?php

namespace App\Events\Game;

use App\Events\CahEvent;

class GameStarted extends CahEvent
{
    public static $identifier = 'game_started';

    protected function evaluateTargetPlayers()
    {
        return array_unique(array_merge(Game::Admins()->get(), $this->game->players()->get()), SORT_REGULAR);
    }
}
