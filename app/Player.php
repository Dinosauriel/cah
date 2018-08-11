<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    /**
     * @return: all games in ownership of this user
     */
    public function games()
    {
        return $this->hasMany('App\Game', 'owner_id');
    }

    /**
     * @return: the game this player is playing
     */
    public function playingGame()
    {
        return $this->belongsTo('App\Game', 'game_id');
    }
}
