<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cardset;

class CardController extends Controller
{
    public function jsonIndex()
    {
        $cardsets = Cardset::all();
        return response()->json([
            'message' => 'listing successful',
            'content' => $cardsets
        ], 200);
    }
}
