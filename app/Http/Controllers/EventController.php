<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Http\Request;
use App\Game;

class EventController extends Controller
{   

    /**
     * receive events from the server for this specific player
     */
    public function poll(Request $request) 
    {
        $response = new StreamedResponse(function() use ($request) {
            ob_start();
            //sleep time in ms
            $sleepTime = 2000;

            while(true) {
                echo "event: " . "joined" . "\n";
                echo "data: " . json_encode([
                    'message' => 'hi',
                    'content' => 'hi'
                ]) . "\n\n";
                ob_flush();
                flush();
                usleep($sleepTime * 1000);
            }
        });
        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('X-Accel-Buffering', 'no');
        $response->headers->set('Cache-Control', 'no-cache');
        return $response;
    } 
}
