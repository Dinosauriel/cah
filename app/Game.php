<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public $timestamps = false;

	protected $fillable = [
		'public_id',
		'name'
	];

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
        return $this->hasMany('App\Player');
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
        return route('updateGame', ['publicId' => $this->public_id]);
    }

    public function getDeleteUrl()
    {
        return route('deleteGame', ['publicId' => $this->public_id]);
    }

    public static function getStoreUrl()
    {
        return route('storeGame');
    }

    public static function getListUrl()
    {
        return route('listGames');
    }
}
