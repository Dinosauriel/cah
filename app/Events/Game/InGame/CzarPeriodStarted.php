<?php

namespace App\Events\Game\InGame;

use App\Events\Ingame\IngameEvent;

class CzarPeriodStarted extends IngameEvent
{
    public static $identifier = 'czar_period_started';
}
