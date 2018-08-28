<?php

namespace App\Events\Game\InGame;

use App\Events\CahEvent;

/**
 * any event that only ingame players receive
 */
abstract class IngameEvent extends CahEvent
{

    /**
     * returns the name of the queue where this event should be submitted 
     */
    public function queueName() {
        return 'game_queue_' . $this->game->id;
    }
}
