<?php

namespace App\Events\Game;

use App\Events\CahEvent;

class GameUpdated extends CahEvent
{
    public static $identifier = 'game_updated';
}
