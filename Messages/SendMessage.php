<?php

namespace Messages;

use GuzzleHttp\Client;

// class SendMessage extends Client
class SendMessage
{

    public function send($messageText)
    {
        debug($this);
        $url = $this->tlgURI . $this->tlgKey . '/sendMessage';
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_POST => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_POSTFIELDS => [
                'chat_id' => $this->chatId, 
                'text' => $messageText
            ],
        ));
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }

    public function __construct($chatId, $tlgURI, $tlgKey)
    {
        $this->chatId = $chatId;
        $this->tlgURI = $tlgURI;
        $this->tlgKey = $tlgKey;
    }
}
