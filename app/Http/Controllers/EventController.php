<?php

namespace App\Http\Controllers;

use App\Player;
use App\Cardset;
use App\Game;

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
    //MARK: - RESPONSE CODES
    const RESPONSE_CODE_SUCCESS = 0;
    const RESPONSE_CODE_ALREADY_AUTHENTICATED = 1;

    const RESPONSE_CODE_NOT_AUTHENTICATED = 10;
    const RESPONSE_CODE_NOT_AUTHORIZED = 11;
    const RESPONSE_CODE_UNKNOWN_CALL = 12;


    //MARK: - CALLS
    const CALL_AUTHENTICATE = 'org.cah.authenticate';
    const CALL_PLAYER_INFO = 'org.cah.player.info';
    const CALL_CARDSETS_LIST = 'org.cah.cardset.list';

    //the game the player is currently playing
    const CALL_GAME_GET = 'org.cah.game.get';
    const CALL_GAME_JOIN = 'org.cah.game.join';
    const CALL_GAME_LIST = 'org.cah.game.list';
    const CALL_GAME_DELETE = 'org.cah.game.delete';
    const CALL_GAME_CREATE = 'org.cah.game.create';

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
        echo 'An error has occurred with user ' . $userId . ': ' . $e->getMessage() . "\n";
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

        $callName = $messageData['call'];
        $callId = $messageData['id'];
        \Illuminate\Support\Facades\Log::debug($messageData);

        //an array of objects
        $parameters = null;
        if (!empty($messageData['parameters'])) {
            $parameters = $messageData['parameters'];
        }

        $isAuthenticated = !is_null($this->connections[$connectionId]['player']);

        if (!$isAuthenticated) {
            if ($callName != static::CALL_AUTHENTICATE) {
                $conn->send($this->encodeMessage($callId, static::RESPONSE_CODE_NOT_AUTHENTICATED, 'not authenticated, please send authentication call'));
                return;
            }
            //this connection is not yet associated with a user
            //we need to authenticate
            $this->authenticatePlayer($conn, $callId, $parameters['token']);
            return;
        }

        $player = $this->connections[$connectionId]['player'];
        $this->onCall($conn, $callId, $callName, $player, $parameters);
    }

    /**
     * @param conn: the websocket connection
     * @param name: the identifier of this api call
     * @param player: the player who executes the call
     * @param parameters: parameters of the method
     */
    private function onCall($conn, $callId, $name, $player, $parameters)
    {
        switch ($name) {
            case static::CALL_AUTHENTICATE:
                $conn->send($this->encodeMessage($callId, static::RESPONSE_CODE_ALREADY_AUTHENTICATED, 'already authenticated'));
                break;
            case static::CALL_PLAYER_INFO:
                $conn->send($this->encodeMessage($callId, static::RESPONSE_CODE_SUCCESS, 'successfull', $player));
                break;
            case static::CALL_CARDSETS_LIST:
                $conn->send($this->encodeMessage($callId, static::RESPONSE_CODE_SUCCESS, 'sucessfull', Cardset::all()));
                break;
            case static::CALL_GAME_JOIN:
                $game = Game::publicId($parameters['gameId'])->first();
                if ($player->joinGame($game)) {
                    $conn->send($this->encodeMessage($callId, static::RESPONSE_CODE_SUCCESS, 'successfull', $game));
                } else {
                    $conn->send($this->encodeMessage($callId, static::RESPONSE_CODE_SUCCESS, 'already joined', $game));
                }
                break;
            case static::CALL_GAME_GET:
                $game = Game::with('players')->publicId($parameters['gameId'])->first();
                if ($player->can('read', $game)) {
                    $conn->send($this->encodeMessage($callId, static::RESPONSE_CODE_SUCCESS, 'successfull', $game));
                } else {
                    $this->sendNotAuthorizedResponse($conn, $callId);
                }
                break;
            case static::CALL_GAME_LIST:
                if ($player->can('list', Game::class)) {
                    $conn->send($this->encodeMessage($callId, static::RESPONSE_CODE_SUCCESS, 'successfull', Game::all()));
                } else {
                    $this->sendNotAuthorizedResponse($conn, $callId);
                }
                break;
            case static::CALL_GAME_DELETE:
                $game = Game::publicId($parameters['gameId'])->first();
                if ($player->can('destroy', $game)) {
                    GameController::deleteGame($game);
                    $conn->send($this->encodeMessage($callId, static::RESPONSE_CODE_SUCCESS, 'successfull'));
                } else {
                    $this->sendNotAuthorizedResponse($conn, $callId);
                }
                break;
            case static::CALL_GAME_CREATE:
                if ($player->can('store', Game::class)) {
                    $game = new Game([
                        'name' => $player->username . 's Game'
                    ]);
                    $game->public_id = GameController::generateNewPublicId();
                    $game = $player->createGame($game);
                    $conn->send($this->encodeMessage($callId, static::RESPONSE_CODE_SUCCESS, 'successfull'));
                } else {
                    $this->sendNotAuthorizedResponse($conn, $callId);
                }
                break;
            default:
                $conn->send($this->encodeMessage($callId, static::RESPONSE_CODE_UNKNOWN_CALL, 'unknown call'));
                break;
        }
    }


    //MARK: Custom Methods
    private function sendNotAuthorizedResponse($conn, $callId)
    {
        $conn->send($this->encodeMessage($callId, static::RESPONSE_CODE_NOT_AUTHORIZED, 'not authorized'));
    }

    /**
     * @param code: code for identifying the response
     * @param message: human readable message for debugging only
     * @param data: payload of the event
     */
    private function encodeMessage($id, $code, $message, $data = null)
    {
        return json_encode(compact('id', 'code', 'message', 'data'));
    }

    private function authenticatePlayer($conn, $callId, $authToken)
    {
        //attempt to auth user
        if (!empty($authToken)) {
            $player = Player::validateCahToken($authToken);
            if (!is_null($player)) {
                $this->connections[$conn->resourceId]['player'] = $player;
                $conn->send($this->encodeMessage($callId, static::RESPONSE_CODE_SUCCESS, 'successfully authenticated'));
                return;
            }
        }
        //not authenticated
        $conn->send($this->encodeMessage($callId, static::RESPONSE_CODE_NOT_AUTHENTICATED, 'not authenticated'));
        return;
    }
}
