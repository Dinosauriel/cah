<?php

namespace App\Events\Game\InGame;

use App\Events\Ingame\IngameEvent;

class CzarSubmittedVerdict extends IngameEvent
{
    public static $identifier = 'czar_submitted_verdict';
}
