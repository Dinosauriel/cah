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

	protected $hidden = [
		'password',
		'cah_token'
	];

	/**
	 * checks for any player using token.
	 * 
	 * @return: player if valid, null else
	 */
	public static function validateCahToken($token)
	{
		return Player::CahToken($token)->first();
	}

	public function scopeCahToken($query, $token)
	{
		return $query->where('api_token', $token);
	}

	public function scopeUsername($query, $username)
	{
		return $query->where('username', $username);
	}

	public function scopeOlderThan($query, $timestamp)
	{
		return $query->where('created_at', '<', date('Y-m-d G:i:s', $timestamp));
	}

	public function scopeAdmins($query)
	{
		return $query->where('is_admin', true);
	}

	public function isAdmin()
	{
		return $this->is_admin == true;
	}

    /**
     * @return: all games in ownership of this user
     */
    public function games()
    {
        return $this->hasMany('App\Game', 'owner_id');
	}
	
	public function gameRelations()
	{
        return $this->hasMany('App\GamePlayerRelation');
    }

    /**
     * @return: the game this player is playing
     */
    public function playingGames()
    {
        return $this->belongsToMany('App\Game');
	}

	/**
	 * @return: is the player playing in this game
	 */
	public function isPlayingGame(Game $game)
	{
		foreach ($this->playingGames()->get() as $g) {
			if ($g->id === $game->id) {
				return true;
			}
		}
		return false;
	}

	/**
	 * 
	 */
	public function joinGame(Game $game)
	{
		if ($this->isPlayingGame($game)) {
			return false;
		}
		$this->playingGames()->attach($game->id);
		return true;
	}
	
	public function createGame(Game $game)
	{
		return $this->games()->save($game);
	}

	public function assignNewApiToken()
	{
		$this->api_token = static::generateNewApiToken();
	}

	protected static function generateNewApiToken()
	{
        return str_random(120);
	}
}
