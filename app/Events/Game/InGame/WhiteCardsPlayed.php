<?php

namespace App\Events\Game\InGame;

use App\Events\Game\Ingame\IngameEvent;

class WhiteCardsPlayed extends IngameEvent
{
    public static $identifier = 'white_cards_played';

    protected function evaluateTargetPlayers()
    {
        return $this->game->players()->get();
    }
}
