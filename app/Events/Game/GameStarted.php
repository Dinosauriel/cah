<?php

namespace App\Events\Game;

use App\Events\CahEvent;

class GameStarted extends CahEvent
{
    public static $identifier = 'game_started';
}
