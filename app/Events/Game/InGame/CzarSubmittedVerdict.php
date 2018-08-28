<?php

namespace App\Events\Game\InGame;

use App\Events\CahEvent;

class CzarSubmittedVerdict extends CahEvent
{
    public static $identifier = 'czar_submitted_verdict';
}
