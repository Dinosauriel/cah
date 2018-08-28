<?php

namespace App\Events\Game\InGame;

use App\Events\Ingame\IngameEvent;

class WhiteCardsPlayed extends IngameEvent
{
    public static $identifier = 'white_cards_played';
}
