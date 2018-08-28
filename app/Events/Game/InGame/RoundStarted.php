<?php

namespace App\Events\Game\InGame;

use App\Events\CahEvent;

class RoundStarted extends CahEvent
{
    public static $identifier = 'round_started';
}
