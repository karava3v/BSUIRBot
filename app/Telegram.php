<?php
/**
 * Created by PhpStorm.
 * User: Karavaev
 * Date: 7/25/2015
 * Time: 4:16 PM
 */

namespace bsuir\app;
use bsuir\app\Bot;

class Telegram extends Bot
{
    public $debugchat = -4376451; //747013;

    /* init, set token  */
    public function __construct($token)
    {
        parent::__construct($token);
    }

    public function returnMessageInfo($message)
    {
        if (!empty($message->message->chat->id)) {
            $return = [
                $message->message->chat->id,
                $message->message->from->username,
                $message->message->from->first_name,
                $message->message->text,
                $message->message->message_id,
                $message
            ];
        } else {
            $return = false;
        }

        return $return;
    }

    public function sendSticker($chat, $sticker)
    {
        $res = [
            'chat_id' => $chat,
            'sticker' => $sticker
        ];
        return $this->sendRequest('telegram', ['method' => 'sendSticker', 'params' => http_build_query($res), 'token' => $this->token]);
    }

    public function sendMessage($chat, $reply)
    {
        $res = [
            'chat_id' => $chat,
            'text' => $reply
        ];
        return $this->sendRequest('telegram', ['method' => 'sendMessage', 'params' => http_build_query($res), 'token' => $this->token]);
    }

    public function forwardMessage($from_chat_id, $message_id, $reply)
    {
        $res = [
            'chat_id' => $this->debugchat,
            'from_chat_id' => $from_chat_id,
            'message_id' => $message_id,
            'text' => $reply
        ];
        return $this->sendRequest('telegram', ['method' => 'forwardMessage', 'params' => http_build_query($res), 'token' => $this->token]);
    }
}
