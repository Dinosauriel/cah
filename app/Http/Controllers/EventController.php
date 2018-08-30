<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redis;
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

            $player = $request->user();
            $queueIdentifier = $player->getQueueIdentifier();

            $i = 0;

            //repeat until connection is aborted
            while(true) {
                //repeat for all events in queue
                while (Redis::llen($queueIdentifier) > 0) {
                    $event = Redis::rpop($queueIdentifier);

                    echo 'event: ' . 'joined' . "\n";
                    echo 'data: ' . json_encode([
                        'message' => 'event received',
                        'content' => $event
                    ]) . "\n\n";
                    ob_flush();
                    flush();
                }

                usleep(700 * 1000);

                if (++$i > 4) {
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
