<?php

namespace App\Listeners;

use App\Events\Game\InGame\RoundStarted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubmitEvent
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  RoundStarted  $event
     * @return void
     */
    public function handle(RoundStarted $event)
    {
        //
    }
}
