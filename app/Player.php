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

	public function scopeUsername($query, $username)
	{
		return $query->where('username', $username);
	}

	public function scopeOlderThan($query, $timestamp)
	{
		return $query->where('created_at', '<', date('Y-m-d G:i:s', $timestamp));
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
    public function playingGames()
    {
        return $this->belongsToMany('App\Game');
	}
	
	public function createGame(Game $game)
	{
		return $this->games()->save($game);
	}
}
