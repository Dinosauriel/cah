<?php

namespace App\Events\Game;

use App\Events\CahEvent;

class PlayerLeft extends CahEvent
{
    public static $identifier = 'player_left';

    protected function evaluateTargetPlayers()
    {
        return array_unique(array_merge(Game::Admins()->get(), $this->game->players()->get()), SORT_REGULAR);
    }
}
