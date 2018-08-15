<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardWhite extends Model
{
    public $timestamps = false;
    public $table = 'cards_white';


    public function cardset()
    {
        return $this->belongsTo(Cardset::class);
    }
}
