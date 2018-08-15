<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cardset;

class CardBlack extends Model
{
    public $timestamps = false;
    public $table = 'cards_black';



    public function cardset()
    {
        return $this->belongsTo(Cardset::class);
    }
}
