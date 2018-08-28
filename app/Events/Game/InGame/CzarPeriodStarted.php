<?php

namespace App\Events\Game\InGame;

use App\Events\CahEvent;

class CzarPeriodStarted extends CahEvent
{
    public static $identifier = 'czar_period_started';
}
