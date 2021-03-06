<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Redis;

class EventSubscriber
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
     * handle the event
     */
    public function handle($event)
    {
        
    }

    /**
     * Handle the event.
     *
     * @param  $events
     * @return void
     */
    public function subscribe($events)
    {
        //MARK - lobby events
        //a player left the game
        $events->listen(
            'App\Events\Game\PlayerLeft',
            'App\Listeners\EventSubscriber@handle'
        );
        //a player joined the game
        $events->listen(
            'App\Events\Game\PlayerJoined',
            'App\Listeners\EventSubscriber@handle'
        );
        //a game has been deleted
        $events->listen(
            'App\Events\Game\GameDeleted',
            'App\Listeners\EventSubscriber@handle'
        );
        //a game has been created
        $events->listen(
            'App\Events\Game\GameCreated',
            'App\Listeners\EventSubscriber@handle'
        );
        //game information (e. g. Cardsets, Win Condition) has been changed
        $events->listen(
            'App\Events\Game\GameUpdated',
            'App\Listeners\EventSubscriber@handle'
        );
        //a game has started (status from draft to ingame)
        $events->listen(
            'App\Events\Game\GameStarted',
            'App\Listeners\EventSubscriber@handle'
        );
        //a game has ended (status from ingame to draft)
        $events->listen(
            'App\Events\Game\GameEnded',
            'App\Listeners\EventSubscriber@handle'
        );

        //MARK: - ingame events
        //any player has submitted his white cards
        $events->listen(
            'App\Events\Game\InGame\WhiteCardsPlayed',
            'App\Listeners\EventSubscriber@handle'
        );
        //every player has submitted their cards or time has run out
        //czar period has started
        $events->listen(
            'App\Events\Game\InGame\CzarPeriodStarted',
            'App\Listeners\EventSubscriber@handle'
        );
        //the czar period is over
        $events->listen(
            'App\Events\Game\InGame\CzarPeriodEnded',
            'App\Listeners\EventSubscriber@handle'
        );
        //the czar has submitted a verdict
        $events->listen(
            'App\Events\Game\InGame\CzarSubmittedVerdict',
            'App\Listeners\EventSubscriber@handle'
        );
        //the next round has started
        $events->listen(
            'App\Events\Game\InGame\RoundStarted',
            'App\Listeners\EventSubscriber@handle'
        );
    }
}
