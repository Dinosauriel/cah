<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use App\Game;

class EventController extends Controller implements MessageComponentInterface
{   
    private $connections = [];
    
    /**
     * When a new connection is opened it will be passed to this method
     * @param  ConnectionInterface $conn The socket/connection that just connected to your application
     * @throws \Exception
     */
    function onOpen(ConnectionInterface $conn){
        $this->connections[$conn->resourceId] = compact('conn') + ['user_id' => null];
    }
   
    /**
     * This is called before or after a socket is closed (depends on how it's closed).
     * SendMessage to $conn will not result in an error if it has already been closed.
     * @param  ConnectionInterface $conn The socket/connection that is closing/closed
     * @throws \Exception
     */
    function onClose(ConnectionInterface $conn){
        $disconnectedId = $conn->resourceId;
        unset($this->connections[$disconnectedId]);
        foreach($this->connections as &$connection) {
            $connection['conn']->send(json_encode([
                'offline_user' => $disconnectedId,
                'from_user_id' => 'server control',
                'from_resource_id' => null
            ]));
        }
    }
   
    /**
     * If there is an error with one of the sockets, or somewhere in the application where an Exception is thrown,
     * the Exception is sent back down the stack, handled by the Server and bubbled back up the application through this method
     * @param  ConnectionInterface $conn
     * @param  \Exception $e
     * @throws \Exception
     */
    function onError(ConnectionInterface $conn, \Exception $e){
        $userId = $this->connections[$conn->resourceId]['user_id'];
        echo "An error has occurred with user $userId: {$e->getMessage()}\n";
        unset($this->connections[$conn->resourceId]);
        $conn->close();
    }
   
    /**
     * Triggered when a client sends data through the socket
     * @param  \Ratchet\ConnectionInterface $conn The socket/connection that sent the message to your application
     * @param  string $msg The message received
     * @throws \Exception
     */
    function onMessage(ConnectionInterface $conn, $msg){
        if(is_null($this->connections[$conn->resourceId]['user_id'])){
            $this->connections[$conn->resourceId]['user_id'] = $msg;
            $onlineUsers = [];
            foreach($this->connections as $resourceId => &$connection){
                $connection['conn']->send(json_encode([$conn->resourceId => $msg]));
                if($conn->resourceId != $resourceId) {
                    $onlineUsers[$resourceId] = $connection['user_id'];
                }
            }
            $conn->send(json_encode(['online_users' => $onlineUsers]));
        } else {
            $fromUserId = $this->connections[$conn->resourceId]['user_id'];
            $msg = json_decode($msg, true);
            $this->connections[$msg['to']]['conn']->send(json_encode([
                'msg' => $msg['content'],
                'from_user_id' => $fromUserId,
                'from_resource_id' => $conn->resourceId
            ]));
        }
    }

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

                //block until we an item is enqueued and then fetch it
                $t = Redis::rpop($queueIdentifier);
                if (empty($t)) {
                    usleep(700 * 1000);
                    continue;
                }
                //\Illuminate\Support\Facades\Log::debug('popped item:' . $t);
                $length = Redis::llen($queueIdentifier);

                echo 'data: ' . json_encode([
                    'message' => 'event received',
                    'content' => $length
                ]) . "\n\n";
                ob_flush();
                flush();

                usleep(700 * 1000);

                // if ($i == 1) {
                //     break;
                // }
                // ++$i;
            }
        });
        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('X-Accel-Buffering', 'no');
        $response->headers->set('Cache-Control', 'no-cache');
        return $response;
    } 
}
