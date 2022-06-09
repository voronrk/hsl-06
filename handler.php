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

const HELP_MESSAGE = '
    Format of command:
    1200 USD to RUR
    there 
    1200 is summ,
    USD is sourse currency,
    RUR is destination currency
';

$incomingMessage = new IncomingMessage(json_decode(file_get_contents('php://input')));

if ($incomingMessage->messageText == '/help') {
    $outgoingMessage = new SendMessage(HELP_MESSAGE, $incomingMessage->chatId, TLG_URI, TLG_KEY);
    debug($outgoingMessage->send());
}

debug($incomingMessage);

$test2 = new SendMessage();

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
    // debug($currencies->getByKey('CharCode', 'JPY'));
    debug($currencies->getByKey('CharCode', 'JPP'));
} catch (CurrencyException $e) {
    debug($e->getMessage());
}






// debug(json_decode(file_get_contents('https://www.cbr-xml-daily.ru/daily_json.js')));

// $log = fopen('test.log', 'w');
// fwrite($log, print_r($client->get(),true));
// fclose($log);

// $chatId = $data->message->chat->id;
// $messageText = $data->message->text;
// $result = curlExec('sendMessage', ['chat_id' => $chatId, 'text' => $messageText]);

// function curlExec($method, $params='') {
//     $url = 'https://api.telegram.org/bot5411827284:AAEsyM8X47_qIFK0rAIqQvs7KAKMzPdrvsQ/';
//     $curl = curl_init();
//     curl_setopt_array($curl, array(
//         CURLOPT_SSL_VERIFYPEER => 0,
//         CURLOPT_POST => 1,
//         CURLOPT_HEADER => 0,
//         CURLOPT_RETURNTRANSFER => 1,
//         CURLOPT_URL => $url . $method,
//         CURLOPT_POSTFIELDS => $params,
//     ));
//     $result = curl_exec($curl);
//     curl_close($curl);
//     return $result;
// };