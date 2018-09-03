<?php

namespace App\Events\Game\InGame;

use App\Events\Game\Ingame\IngameEvent;

class CzarSubmittedVerdict extends IngameEvent
{
    public static $identifier = 'czar_submitted_verdict';

    protected function evaluateTargetPlayers()
    {
        return $this->game->players()->get();
    }
}
