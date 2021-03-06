<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cardset extends Model
{
	public $timestamps = false;

    public $fillable = [
        'name',
        'acronym'
    ];

    /* 
    Returns all Games that include this Cardset
    */
    public function games() {
        return $this->belongsToMany('App\Game');
    }
}
