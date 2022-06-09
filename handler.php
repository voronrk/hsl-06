<?php
require_once 'vendor/autoload.php';
require_once 'Config.php';

use GuzzleHttp\Client;
use Currency\OneCurrency;
use Currency\AllCurrencies;
use Currency\CurrencyException;
use Messages\IncomingMessage;
use Messages\SendMessage;
use Config\Config;

function debug($data)
{
    $log = fopen('log.log', 'a');
    fwrite($log, print_r($data,true));
    fclose($log);
}

// const BASE_URI = 'http://www.cbr-xml-daily.ru';
// const METHOD = '/daily_json.js';
// const TLG_URI = 'https://api.telegram.org/bot';

define('BASE_URI', Config::$baseURI);
define('METHOD', Config::$method);
define('TLG_URI', Config::$tldUri);
define('TLG_KEY', Config::$tlgKey);

const HELP_MESSAGE = 'Введите код валюты для просмотра текущего курса к рублю';
// const HELP_MESSAGE = '
//     Format of command:
    
//     1200 USD to RUR
    
// there 
//     1200 is sum,
//     USD is sourse currency,
//     RUR is destination currency
// ';

$incomingData = json_decode(file_get_contents('php://input'));
$chatId = $incomingData->message->chat->id;
$messageText = $incomingData->message->text;

$outgoingMessage = new SendMessage($chatId, TLG_URI, TLG_KEY);

try {
    $incomingMessage = new IncomingMessage($messageText);

    if ($incomingMessage->isHelp) {
        $outgoingMessage->send(HELP_MESSAGE);
    }
    if ($incomingMessage->isCodeCorrect) {
        $outgoingMessage->send(getCurrency($messageText));
    }
} catch (CurrencyException $e) {
    $e->sendToTlg($outgoingMessage, $e->getMessage());
}

function getCurrency($currencyCode): double
{
    debug($currencyCode . PHP_EOL);
    $client = new Client([
        'base_uri' => BASE_URI,
    ]);

    try {
        $responce = $client->request('GET', METHOD);
        $data = json_decode($responce->getBody()->getContents())->Valute;

        $currencies = new AllCurrencies();

        foreach($data as $item) {
            $currencies->addCurrency(new OneCurrency($item));
        };
        debug($currencies);
        return $currencies->getByKey('CharCode', 'USD')['Value'];
    } catch (CurrencyException $e) {
        debug($e->getMessage());
    }
}