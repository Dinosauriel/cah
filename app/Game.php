<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public $timestamps = false;


    public function scopePublicId($query, $publicId) {
        return $query->where('public_id', $publicId);
    }
}
