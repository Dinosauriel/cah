<?php

namespace App\Events\Game;

use App\Events\Game\CahEvent;

class GameEnded extends CahEvent
{
    public static $identifier = 'game_ended';

    protected function evaluateTargetPlayers()
    {
        return array_unique(array_merge(Game::Admins()->get(), $this->game->players()->get()), SORT_REGULAR);
    }
}
