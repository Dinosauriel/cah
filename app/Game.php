<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public $timestamps = false;

	protected $fillable = [
		'name',
		'points_required'
    ];
    
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

    /**
     * @return: the owner of this game
     */
    public function owner()
    {
        return $this->belongsTo('App\Player');
    }

    public function getDraftUrl()
    {
        return route('viewGame', ['publicId' => $this->public_id]);
    }

    public function getUpdateUrl()
    {
        return route('ajax_updateGame', ['publicId' => $this->public_id]);
    }

    public function getDeleteUrl()
    {
        return route('ajax_destroyGame', ['publicId' => $this->public_id]);
    }

    public static function getStoreUrl()
    {
        return route('ajax_storeGame');
    }

    public static function getListUrl()
    {
        return route('listGames');
    }
}
