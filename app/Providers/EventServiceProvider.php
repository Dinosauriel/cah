<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        //MARK - lobby events
        //a player left the game
        'App\Events\Game\PlayerLeft' => [
            'App\Listeners\SubmitEvent',
        ],
        //a player joined the game
        'App\Events\Game\PlayerJoined' => [
            'App\Listeners\SubmitEvent',
        ],
        //a game has been deleted
        'App\Events\Game\GameDeleted' => [
            'App\Listeners\SubmitEvent',
        ],
        //a game has been created
        'App\Events\Game\GameCreated' => [
            'App\Listeners\SubmitEvent',
        ],
        //game information (e. g. Cardsets, Win Condition) has been changed
        'App\Events\Game\GameUpdated' => [
            'App\Listeners\SubmitEvent',
        ],
        //a game has started (status from draft to ingame)
        'App\Events\Game\GameStarted' => [
            'App\Listeners\SubmitEvent',
        ],
        //a game has ended (status from ingame to draft)
        'App\Events\Game\GameEnded' => [
            'App\Listeners\SubmitEvent',
        ],

        //MARK: - ingame events
        //any player has submitted his white cards
        'App\Events\Game\InGame\WhiteCardsPlayed' => [
            'App\Listeners\SubmitEvent',
        ],
        //every player has submitted their cards or time has run out
        //czar period has started
        'App\Events\Game\InGame\CzarPeriodStarted' => [
            'App\Listeners\SubmitEvent',
        ],
        //the czar period is over
        'App\Events\Game\InGame\CzarPeriodEnded' => [
            'App\Listeners\SubmitEvent',
        ],
        //the czar has submitted a verdict
        'App\Events\Game\InGame\CzarSubmittedVerdict' => [
            'App\Listeners\SubmitEvent',
        ],
        //the next round has started
        'App\Events\Game\InGame\RoundStarted' => [
            'App\Listeners\SubmitEvent',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
