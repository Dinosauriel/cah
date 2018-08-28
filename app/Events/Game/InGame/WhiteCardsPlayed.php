<?php

namespace App\Events\Game\InGame;

use App\Events\CahEvent;

class WhiteCardsPlayed extends CahEvent
{
    public static $identifier = 'white_cards_played';
}
