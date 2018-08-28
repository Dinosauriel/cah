<?php

namespace App\Events\Game;

use App\Events\CahEvent;

class PlayerLeft extends CahEvent
{
    public static $identifier = 'player_left';
}
