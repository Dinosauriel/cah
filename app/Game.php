<?php

namespace App;

use App\Player;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public $timestamps = false;

	protected $fillable = [
		'name',
		'points_required'
    ];

    protected $appends = [
        'route',
        'relative_route',
        'owner_username'
    ];

    protected $hidden = [
        'cah_token'
    ];

    /**
     * join url attribute
     *
     * @return string
     */
    public function getRouteAttribute() 
    {
        return $this->getRoute(true);
    }

    public function getRelativeRouteAttribute()
    {
        return $this->getRoute();
    }

    public function getOwnerUsernameAttribute()
    {
        return $this->owner->username;
    }
    
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'public_id';
    }

    public function scopePublicId($query, $publicId)
    {
        return $query->where('public_id', $publicId);
    }

    /** 
    * @return: all cardsets that are in this game
    */
    public function cardsets()
    {
        return $this->belongsToMany('App\Cardset');
    }

    /**
     * @return: all players participating in this game 
     */
    public function players()
    {
        return $this->belongsToMany('App\Player');
    }

    public function playerRelations()
    {
        return $this->hasMany('App\GamePlayerRelation');
    }

    public function hasPlayer(Player $p)
    {
        return ($this->players()->where('player_id', $p->id)->count() > 0);
    }

    /**
     * @return: the owner of this game
     */
    public function owner()
    {
        return $this->belongsTo('App\Player');
    }

    public function getRoute($isAbsolute = false)
    {
        return route('viewGame', ['gameId' => $this->public_id], $isAbsolute);
    }
}
