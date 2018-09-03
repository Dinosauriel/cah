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
        'join_route',
        'delete_route'
    ];

    /**
     * join url attribute
     *
     * @return string
     */
    public function getJoinRouteAttribute()
    {
        return $this->getRoute();
    }

    /**
     * delete url attribute
     *
     * @return string
     */
    public function getDeleteRouteAttribute()
    {
        return $this->getDeleteRoute();
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
        return $this->belongsTo('App\Player')->first();
    }

    public function getRoute()
    {
        return route('viewGame', ['gameId' => $this->public_id]);
    }

    public function getUpdateRoute()
    {
        return route('api_updateGame', ['publicId' => $this->public_id]);
    }

    public function getDeleteRoute()
    {
        return route('api_destroyGame', ['publicId' => $this->public_id]);
    }

    public static function getStoreRoute()
    {
        return route('api_storeGame');
    }

    public static function getListRoute()
    {
        return route('listGames');
    }
}
