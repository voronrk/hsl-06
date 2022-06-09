<?php

namespace Messages;

class IncomingMessage
{
    public function __construct($data) 
    {
        $this->data = $data;
        $this->chatId = $data->message->chat->id;
        $this->messageText = $data->message->text;
    }
}