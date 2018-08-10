<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public $timestamps = false;


    public function scopePublicId($query, $publicId) {
        return $query->where('public_id', $publicId);
    }

    public function getDraftUrl() {
        return route('viewGame', ['publicId' => $this->public_id]);
    }

    public function getUpdateUrl() {
        return route('updateGame', ['publicId' => $this->public_id]);
    }

    public function getDeleteUrl() {
        return route('deleteGame', ['publicId' => $this->public_id]);
    }

    public static function getStoreUrl() {
        return route('storeGame');
    }

    public static function getListUrl() {
        return route('listGames');
    }
}
