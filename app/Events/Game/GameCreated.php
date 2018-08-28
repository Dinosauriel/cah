<?php

namespace App\Events\Game;

use App\Events\CahEvent;

class GameCreated extends CahEvent
{
    public static $identifier = 'game_created';
}
