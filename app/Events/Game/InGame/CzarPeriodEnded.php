<?php

namespace App\Events\Game\InGame;

use App\Events\CahEvent;

class CzarPeriodEnded extends CahEvent
{
    public static $identifier = 'czar_period_ended';
}
