<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Player extends Authenticatable
{
	public $timestamps = true;

	protected $fillable = [
		'username',
		'password'
	];

	public function scopeUsername($query, $username) {
		return $query->where('username', $username);
	}

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
	
	public function createGame(Game $game)
	{
		return $this->games()->save($game);
	}
}
