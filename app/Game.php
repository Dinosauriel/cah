<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public $timestamps = false;


    public function scopePublicId($query, $publicId) {
        return $query->where('public_id', $publicId);
    }

    public function getBaseUrl() {
        return '/games/' . $this->public_id;
    }

    public function getUpdateUrl() {
        return $this->getBaseUrl() . '/update';
    }

    public function getDeleteUrl() {
        return $this->getBaseUrl() . '/delete';
    }

    public static function getStoreUrl() {
        return '/games/create';
    }
}
