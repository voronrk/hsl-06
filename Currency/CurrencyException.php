<?php

namespace Currency;

use Exception;
use Messages\SendMessage;
use Config\Config;

class CurrencyException extends Exception
{
    public static function sendToTlg(SendMessage $sendMessage, $message)
    {
        $sendMessage->send($message);
    }
}
