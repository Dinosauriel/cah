<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Game;
use App\Player;

class GamePlayerRelation extends Model
{
    public $timestamps = false;
    public $table = 'game_player';


    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
