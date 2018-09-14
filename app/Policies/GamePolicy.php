<?php

namespace App\Policies;

use App\Game;
use App\Player;
use Illuminate\Auth\Access\HandlesAuthorization;

class GamePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * can this player create new games 
     */
    public function store(Player $p)
    {
        return $p->isAdmin();
    }
    
    /**
     * can this player receive a listing of games 
     */
    public function list(Player $p)
    {
        return $p->isAdmin();
    }

    /**
     * can this player receive info about this game
     */
    public function read(Player $p, Game $g)
    {
        return $g->hasPlayer($p) || $p->isAdmin();
    }

    /**
     * can this player delete the specified game
     */
    public function destroy(Player $p, Game $g)
    {
        return $g->owner->id == $p->id || $p->isAdmin();
    }

    /**
     * can this player edit the specified game 
     */
    public function update(Player $p, Game $g)
    {
        return $g->owner->id == $p->id;
    }
}
