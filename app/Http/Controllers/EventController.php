<?php

namespace App\Http\Controllers;

use App\Player;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
//events
use App\Events\Game\GameCreated;
use App\Events\Game\GameDeleted;
use App\Events\Game\GameEnded;
use App\Events\Game\GameStarted;
use App\Events\Game\GameUpdated;
use App\Events\Game\PlayerJoined;
use App\Events\Game\PlayerLeft;
//ingame events
use App\Events\Game\Ingame\CzarPeriodEnded;
use App\Events\Game\Ingame\CzarPeriodStarted;
use App\Events\Game\Ingame\CzarSubmittedVerdict;
use App\Events\Game\Ingame\RoundStarted;
use App\Events\Game\Ingame\WhiteCardsPlayed;

class EventController extends Controller implements MessageComponentInterface
{   
    private $connections = [];
    
    /**
     * When a new connection is opened it will be passed to this method
     * @param  ConnectionInterface $conn The socket/connection that just connected to your application
     * @throws \Exception
     */
    function onOpen(ConnectionInterface $conn)
    {
        $this->connections[$conn->resourceId] = [
            'conn' => $conn,
            'connection_id' => null,
            'player' => null,
        ];
    }
   
    /**
     * This is called before or after a socket is closed (depends on how it's closed).
     * SendMessage to $conn will not result in an error if it has already been closed.
     * @param  ConnectionInterface $conn The socket/connection that is closing/closed
     * @throws \Exception
     */
    function onClose(ConnectionInterface $conn)
    {
        $disconnectedId = $conn->resourceId;
        unset($this->connections[$disconnectedId]);
    }
   
    /**
     * If there is an error with one of the sockets, or somewhere in the application where an Exception is thrown,
     * the Exception is sent back down the stack, handled by the Server and bubbled back up the application through this method
     * @param  ConnectionInterface $conn
     * @param  \Exception $e
     * @throws \Exception
     */
    function onError(ConnectionInterface $conn, \Exception $e)
    {
        $userId = $this->connections[$conn->resourceId]['connection_id'];
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
    function onMessage(ConnectionInterface $conn, $msg)
    {
        $connectionId = $conn->resourceId;
        $messageData = json_decode($msg, true);

        if (is_null($this->connections[$connectionId]['player'])) {
            //this connection is not yet associated with a user
            //we need to authenticate
            $this->authenticatePlayer($connectionId, $messageData);
            return;
        }
    }


    //MARK: Custom Methods
    private function encodeMessage($message, $data = null)
    {
        return json_encode(compact('message', 'data'));
    }

    private function authenticatePlayer($connectionId, $messageData)
    {
        //attempt to auth user
        if (!empty($messageData['cah_token'])) {
            $player = Player::validateCahToken($messageData['cah_token']);
            if (!is_null($player)) {
                $this->connections[$connectionId]['player'] = $player;
                $conn->send($this->encodeMessage('successfully authenticated'));
                return;
            }
        }
        //not authenticated
        $conn->send($this->encodeMessage('not authenticated'));
        return;
    }
}
