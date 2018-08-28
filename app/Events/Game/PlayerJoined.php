<?php

namespace App\Events\Game;

use App\Events\CahEvent;

class PlayerJoined extends CahEvent
{
    public static $identifier = 'player_joined';
}
