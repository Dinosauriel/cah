<?php

namespace App\Events\Game;

use App\Events\Game\CahEvent;

class GameDeleted extends CahEvent
{
    public static $identifier = 'game_deleted';

    protected function evaluateTargetPlayers()
    {
        return \App\Player::Admins()->get();
    }
}
