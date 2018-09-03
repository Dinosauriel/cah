<?php

namespace App\Events\Game;

use App\Events\Game\CahEvent;

class PlayerJoined extends CahEvent
{
    public static $identifier = 'player_joined';

    protected function evaluateTargetPlayers()
    {
        return array_unique(array_merge(Game::Admins()->get(), $this->game->players()->get()), SORT_REGULAR);
    }
}
