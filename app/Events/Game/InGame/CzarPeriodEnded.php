<?php

namespace App\Events\Game\InGame;

use App\Events\Ingame\IngameEvent;

class CzarPeriodEnded extends IngameEvent
{
    public static $identifier = 'czar_period_ended';

    protected function evaluateTargetPlayers()
    {
        return $this->game->players()->get();
    }
}
