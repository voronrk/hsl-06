<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;
use Currency\OneCurrency;
use Currency\AllCurrencies;
use Exception\CurrencyException;

function debug($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

const BASE_URI = 'http://www.cbr-xml-daily.ru';
const METHOD = '/daily_json.js';

const TLG_URI = 'https://api.telegram.org/bot';

$incomingData = json_decode(file_get_contents('php://input'));

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
} catch (Exception $e) {
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