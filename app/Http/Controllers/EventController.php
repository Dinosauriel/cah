<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Http\Request;
use App\Game;

class EventController extends Controller
{   

    public function poll(Game $game, Request $request) 
    {
        $response = new StreamedResponse(function() use ($request) {
            $i = 0;

            while(true) {
                echo json_encode([
                    'message' => 'hi',
                    'content' => 'hi'
                ]);
                //ob_flush();
                flush();
                usleep(200000);
                if (++$i == 5) {
                    break;
                }
            }
        });
        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('X-Accel-Buffering', 'no');
        $response->headers->set('Cache-Control', 'no-cache');
        return $response;
    } 
}
