<?php

namespace App\Events\Game;

use App\Events\Game\CahEvent;

class GameStarted extends CahEvent
{
    public static $identifier = 'game_started';

    protected function evaluateTargetPlayers()
    {
        return array_unique(array_merge(Game::Admins()->get(), $this->game->players()->get()), SORT_REGULAR);
    }
}
