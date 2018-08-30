<?php

namespace App\Events\Game\InGame;

use App\Events\Ingame\IngameEvent;

class RoundStarted extends IngameEvent
{
    public static $identifier = 'round_started';

    protected function evaluateTargetPlayers()
    {
        return $this->game->players()->get();
    }
}
