<?php

namespace Messages;

use Currency\CurrencyException;

class IncomingMessage
{

    private $currencyCodes = [
    'AUD',
    'AZN',
    'GBP',
    'AMD',
    'BYN',
    'BGN',
    'BRL',
    'HUF',
    'HKD',
    'DKK',
    'USD',
    'EUR',
    'INR',
    'KZT',
    'CAD',
    'KGS',
    'CNY',
    'MDL',
    'NOK',
    'PLN',
    'RON',
    'XDR',
    'SGD',
    'TJS',
    'TRY',
    'TMT',
    'UZS',
    'UAH',
    'CZK',
    'SEK',
    'CHF',
    'ZAR',
    'KRW',
    'JPY',
    ];

    public bool $isHelp = false;
    public $isCodeCorrect = false;

    private function parseMessage() 
    {
        if ($this->messageText == '/help') {
            $this->isHelp = true;
            return;
        };
        $this->isCodeCorrect = array_search($this->messageText, $this->currencyCodes);
        debug($this->CODES);
        if ($this->isCodeCorrect === false) {
            throw new CurrencyException('Некорректный код');
        };
    }

    public function __construct($messageText) 
    {
        $this->messageText = $messageText;
        $this->parseMessage();
    }
}
