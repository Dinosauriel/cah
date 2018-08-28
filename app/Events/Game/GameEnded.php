<?php

namespace App\Events\Game;

use App\Events\CahEvent;

class GameEnded extends CahEvent
{
    public static $identifier = 'game_ended';
}
