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
}
